<?php include '../config/conn_db.php';?>
<?php
// On démarre une session pour pouvoir utiliser les variables de session
// C'est comme ouvrir un petit carnet personnel pour l'utilisateur
session_start();

// On vérifie si l'utilisateur est connecté en cherchant son ID dans la session
// Si l'ID n'existe pas, c'est qu'il n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    // On le renvoie vers la page de connexion
    header('Location: login.php');
    // On arrête l'exécution du script pour éviter tout problème
    exit;
}



// On vérifie si la connexion a réussi
// C'est comme vérifier si la clé a bien ouvert la porte


// On s'assure que les caractères spéciaux seront bien traités
// C'est comme s'assurer qu'on peut lire toutes les langues dans notre bibliothèque
$mysqli->set_charset("utf8");

// On récupère l'identifiant du projet depuis l'URL
// C'est comme chercher le numéro de la salle où on doit aller
if (!isset($_GET['project_id']) || empty($_GET['project_id'])) {
    // Si l'identifiant n'est pas fourni, on renvoie vers la liste des projets
    header('Location: projet.php');
    exit;
}

// On convertit l'identifiant en nombre entier pour éviter les injections SQL
// C'est comme s'assurer que le numéro de salle est bien un nombre
$project_id = intval($_GET['project_id']);

// On récupère les informations du projet depuis la base de données
// C'est comme chercher toutes les informations sur la salle qu'on va utiliser
$stmt = $mysqli->prepare('SELECT p.ID_PROJET, p.NOM_PROJET as name, e.NOM_TEAM as team_name 
                         FROM PROJET p 
                         JOIN AVOIR a ON p.ID_PROJET = a.ID_PROJET 
                         JOIN EQUIPES e ON a.ID_TEAM = e.ID_TEAM 
                         WHERE p.ID_PROJET = ?');

// On lie le paramètre (l'ID du projet) à notre requête
// C'est comme mettre le bon numéro de salle dans notre demande
$stmt->bind_param('i', $project_id);

// On exécute la requête
// C'est comme envoyer notre demande à la bibliothèque
$stmt->execute();

// On récupère le résultat
// C'est comme recevoir la réponse de la bibliothèque
$result = $stmt->get_result();

// On vérifie si le projet existe
// C'est comme vérifier si la salle existe vraiment
if ($result->num_rows === 0) {
    // Si le projet n'existe pas, on renvoie vers la liste des projets
    header('Location: projets.php');
    exit;
}

// On récupère les données du projet
// C'est comme lire les informations qu'on a reçues
$project = $result->fetch_assoc();

// On ferme cette requête pour en préparer une nouvelle
// C'est comme ranger un livre avant d'en prendre un autre
$stmt->close();

// On récupère la liste des membres de l'équipe associée au projet
// C'est comme obtenir la liste des personnes qui peuvent travailler dans cette salle
$stmt = $mysqli->prepare('SELECT u.ID_USER as id, u.NAME_USER as username 
                         FROM UTILISATEURS u 
                         JOIN APPARTENIR a ON u.ID_USER = a.ID_USER 
                         JOIN AVOIR av ON a.ID_TEAM = av.ID_TEAM 
                         WHERE av.ID_PROJET = ?');

// On lie le paramètre à notre requête
$stmt->bind_param('i', $project_id);

// On exécute la requête
$stmt->execute();

// On récupère le résultat
$result = $stmt->get_result();

// On prépare un tableau pour stocker tous les membres de l'équipe
// C'est comme préparer une liste vide pour y mettre des noms
$team_members = [];

// On parcourt les résultats pour remplir notre tableau
// C'est comme écrire chaque nom sur notre liste, un par un
while ($member = $result->fetch_assoc()) {
    $team_members[] = $member;
}

// On ferme cette requête
$stmt->close();

// On initialise la variable d'erreur à vide
// C'est comme préparer un papier pour noter les problèmes, mais il est vide pour l'instant
$error = '';

// On vérifie si le formulaire a été soumis
// C'est comme vérifier si quelqu'un a appuyé sur le bouton "Envoyer"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // On récupère toutes les données du formulaire
        // C'est comme ramasser tous les papiers qu'on nous a donnés
        
        // Le titre de la tâche (obligatoire)
        $title = trim($_POST['title']);
        
        // La description de la tâche (optionnelle)
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        
        // L'identifiant de la personne à qui on assigne la tâche
        $assignee_id = intval($_POST['assignee_id']);
        
        // Le statut de la tâche (à faire, en cours, etc.)
        $status = $_POST['status'];
        
        // La priorité de la tâche (basse, moyenne, etc.)
        $priority = $_POST['priority'];
        
        // Le nombre d'heures estimées pour accomplir la tâche
        $estimated_hours = !empty($_POST['estimated_hours']) ? floatval($_POST['estimated_hours']) : null;
        
        // La date d'échéance de la tâche
        $due_date = $_POST['due_date'];
        
        // On vérifie que les champs obligatoires sont remplis
        // C'est comme s'assurer qu'on a bien tous les papiers importants
        if (empty($title)) {
            throw new Exception("Le titre de la tâche est obligatoire.");
        }
        
        if (empty($assignee_id)) {
            throw new Exception("Vous devez assigner la tâche à un membre de l'équipe.");
        }
        
        if (empty($due_date)) {
            throw new Exception("La date d'échéance est obligatoire.");
        }
        
        // On convertit les valeurs du formulaire en valeurs pour la base de données
        // C'est comme traduire des mots d'une langue à une autre
        
        // Pour la priorité
        $priority_map = [
            'low' => 'Basse',
            'medium' => 'Moyenne',
            'high' => 'Haute',
            'critical' => 'Critique'
        ];
        
        // Pour le statut
        $status_map = [
            'todo' => 'À faire',
            'in_progress' => 'En cours',
            'review' => 'En révision',
            'done' => 'Terminé'
        ];
        
        // On vérifie si la table TACHES a toutes les colonnes dont on a besoin
        // C'est comme vérifier si notre classeur a toutes les sections nécessaires
        
        // On vérifie si la colonne DESCRIPTION_TACHE existe
        $result = $mysqli->query("SHOW COLUMNS FROM TACHES LIKE 'DESCRIPTION_TACHE'");
        if ($result->num_rows === 0) {
            // Si elle n'existe pas, on la crée
            $mysqli->query("ALTER TABLE TACHES ADD COLUMN DESCRIPTION_TACHE TEXT AFTER DATE_FIN_TACHE_");
        }
        
        // On vérifie si la colonne ASSIGNEE_ID existe
        $result = $mysqli->query("SHOW COLUMNS FROM TACHES LIKE 'ASSIGNEE_ID'");
        if ($result->num_rows === 0) {
            // Si elle n'existe pas, on la crée
            $mysqli->query("ALTER TABLE TACHES ADD COLUMN ASSIGNEE_ID INT AFTER DESCRIPTION_TACHE");
        }
        
        // On vérifie si la colonne ESTIMATED_HOURS existe
        $result = $mysqli->query("SHOW COLUMNS FROM TACHES LIKE 'ESTIMATED_HOURS'");
        if ($result->num_rows === 0) {
            // Si elle n'existe pas, on la crée
            $mysqli->query("ALTER TABLE TACHES ADD COLUMN ESTIMATED_HOURS FLOAT AFTER ASSIGNEE_ID");
        }
        
        // On prépare la priorité et le statut selon nos mappages
        $priorite_tache = $priority_map[$priority];
        $statut_tache = $status_map[$status];
        $date_debut = date('Y-m-d'); // Date d'aujourd'hui
        
        // On insère la nouvelle tâche dans la base de données
        // C'est comme écrire toutes les informations dans notre classeur
        $stmt = $mysqli->prepare('INSERT INTO TACHES (ID_PROJET, TITRE_TACHE_, PRIORITER_TACHE_, STATUT_TACHE_, DATE_DEBUT_TACHE_, DATE_FIN_TACHE_, DESCRIPTION_TACHE, ASSIGNEE_ID, ESTIMATED_HOURS) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        
        // On lie les paramètres à notre requête
        // C'est comme remplir chaque case de notre formulaire avec la bonne information
        $stmt->bind_param('issssssid', 
            $project_id,                  // L'ID du projet (i = integer)
            $title,                       // Le titre de la tâche (s = string)
            $priorite_tache,              // La priorité traduite (s = string)
            $statut_tache,                // Le statut traduit (s = string)
            $date_debut,                  // La date de début (s = string)
            $due_date,                    // La date d'échéance (s = string)
            $description,                 // La description (s = string)
            $assignee_id,                 // L'ID de la personne assignée (i = integer)
            $estimated_hours              // Les heures estimées (d = double/float)
        );
        
        // On exécute la requête
        // C'est comme envoyer notre formulaire rempli
        $stmt->execute();
        
        // On vérifie si l'insertion a réussi
        // C'est comme vérifier si notre formulaire a bien été accepté
        if ($stmt->affected_rows > 0) {
            // Si tout s'est bien passé, on redirige vers la page du projet
            // C'est comme dire "Mission accomplie, retournons à la salle principale"
            header("Location: vue_projet.php?id=$project_id");
            exit;
        } else {
            // Si l'insertion a échoué, on lance une erreur
            throw new Exception("Erreur lors de l'ajout de la tâche. Veuillez réessayer.");
        }
        
        // On ferme la requête
        $stmt->close();
        
    } catch (Exception $e) {
        // Si une erreur se produit, on la capture pour l'afficher à l'utilisateur
        // C'est comme noter un problème pour le signaler
        $error = $e->getMessage();
    }
}
?>
