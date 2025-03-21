<?php include '../config/conn_db.php';?>

<?php
// Fichier: teams.php



// Récupérer tous les utilisateurs pour les afficher dans le formulaire, classés par statut
function getAllUsers() {
    $conn = connectDB();
    $users = [];
    
    $query = "SELECT ID_USER, NAME_USER, EMAIL, ROLE, STATUS_USER FROM UTILISATEURS ORDER BY STATUS_USER, NAME_USER";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    
    $result->free();
    $conn->close();
    
    return $users;
}

// Récupérer toutes les équipes pour les afficher
function getAllTeams() {
    $conn = connectDB();
    $teams = [];
    
    $query = "
        SELECT e.*, COUNT(a.ID_USER) as member_count, 
               COUNT(DISTINCT av.ID_PROJET) as project_count
        FROM EQUIPES e
        LEFT JOIN APPARTENIR a ON e.ID_TEAM = a.ID_TEAM
        LEFT JOIN AVOIR av ON e.ID_TEAM = av.ID_TEAM
        GROUP BY e.ID_TEAM
        ORDER BY e.NOM_TEAM
    ";
    
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teams[] = $row;
        }
    }
    
    $result->free();
    $conn->close();
    
    return $teams;
}

// Récupérer les membres d'une équipe
function getTeamMembers($teamId) {
    $conn = connectDB();
    $members = [];
    
    $query = "
        SELECT u.ID_USER, u.NAME_USER, u.EMAIL, u.ROLE, u.STATUS_USER
        FROM UTILISATEURS u
        JOIN APPARTENIR a ON u.ID_USER = a.ID_USER
        WHERE a.ID_TEAM = ?
        ORDER BY u.STATUS_USER, u.NAME_USER
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $teamId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    }
    
    $stmt->close();
    $conn->close();
    
    return $members;
}

// Créer une nouvelle équipe
function createTeam($name, $description, $leader, $members) {
    $conn = connectDB();
    $teamId = 0;
    
    try {
        // Démarrer une transaction
        $conn->begin_transaction();
        
        // Insérer l'équipe
        $query = "INSERT INTO EQUIPES (NOM_TEAM, DESCRIPTION_TEAM, LEADER) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $description, $leader);
        
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de la création de l'équipe: " . $stmt->error);
        }
        
        // Récupérer l'ID de l'équipe nouvellement créée
        $teamId = $conn->insert_id;
        $stmt->close();
        
        // Ajouter les membres à l'équipe
        if (!empty($members)) {
            $query = "INSERT INTO APPARTENIR (ID_USER, ID_TEAM) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            
            foreach ($members as $memberId) {
                $stmt->bind_param("ii", $memberId, $teamId);
                
                if (!$stmt->execute()) {
                    throw new Exception("Erreur lors de l'ajout des membres: " . $stmt->error);
                }
            }
            
            $stmt->close();
        }
        
        // Valider la transaction
        $conn->commit();
        
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollback();
        throw $e;
    } finally {
        // Fermer la connexion
        $conn->close();
    }
    
    return $teamId;
}

// Ajouter un membre à une équipe existante
function addTeamMember($teamId, $userId) {
    $conn = connectDB();
    
    try {
        // Vérifier si l'utilisateur est déjà membre de l'équipe
        $checkQuery = "SELECT * FROM APPARTENIR WHERE ID_USER = ? AND ID_TEAM = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ii", $userId, $teamId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        
        if ($checkResult->num_rows > 0) {
            $checkStmt->close();
            return false; // L'utilisateur est déjà membre
        }
        
        $checkStmt->close();
        
        // Ajouter l'utilisateur à l'équipe
        $query = "INSERT INTO APPARTENIR (ID_USER, ID_TEAM) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $userId, $teamId);
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
        
    } catch (Exception $e) {
        throw $e;
    } finally {
        $conn->close();
    }
}

// Supprimer un membre d'une équipe
function removeTeamMember($teamId, $userId) {
    $conn = connectDB();
    
    try {
        $query = "DELETE FROM APPARTENIR WHERE ID_USER = ? AND ID_TEAM = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $userId, $teamId);
        
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
        
    } catch (Exception $e) {
        throw $e;
    } finally {
        $conn->close();
    }
}

// Traitement des actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    // Création d'une nouvelle équipe
    if ($action === 'create_team' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Validation des données
            if (empty($_POST['name'])) {
                throw new Exception("Le nom de l'équipe est obligatoire");
            }
            
            $name = trim($_POST['name']);
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $leader = isset($_POST['leader']) ? trim($_POST['leader']) : '';
            $members = isset($_POST['members']) ? $_POST['members'] : [];
            
            // Créer l'équipe
            $teamId = createTeam($name, $description, $leader, $members);
            
            // Rediriger avec un message de succès
            header("Location: teams.php?success=1&message=Équipe créée avec succès");
            exit;
            
        } catch (Exception $e) {
            // Rediriger avec un message d'erreur
            header("Location: teams.php?error=1&message=" . urlencode($e->getMessage()));
            exit;
        }
    }
    
    // Ajouter un membre à une équipe
    if ($action === 'add_member' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if (!isset($_POST['team_id']) || !isset($_POST['user_id'])) {
                throw new Exception("Données manquantes pour ajouter un membre");
            }
            
            $teamId = (int)$_POST['team_id'];
            $userId = (int)$_POST['user_id'];
            
            $result = addTeamMember($teamId, $userId);
            
            if ($result) {
                header("Location: teams.php?success=1&message=Membre ajouté avec succès");
            } else {
                header("Location: teams.php?error=1&message=Ce membre fait déjà partie de l'équipe");
            }
            exit;
            
        } catch (Exception $e) {
            header("Location: teams.php?error=1&message=" . urlencode($e->getMessage()));
            exit;
        }
    }
    
    // Supprimer un membre d'une équipe
    if ($action === 'remove_member' && isset($_GET['team_id']) && isset($_GET['user_id'])) {
        try {
            $teamId = (int)$_GET['team_id'];
            $userId = (int)$_GET['user_id'];
            
            $result = removeTeamMember($teamId, $userId);
            
            if ($result) {
                header("Location: teams.php?success=1&message=Membre retiré avec succès");
            } else {
                header("Location: teams.php?error=1&message=Erreur lors de la suppression du membre");
            }
            exit;
            
        } catch (Exception $e) {
            header("Location: teams.php?error=1&message=" . urlencode($e->getMessage()));
            exit;
        }
    }
}

// Affichage de la page
$users = getAllUsers();
$teams = getAllTeams();

// Regrouper les utilisateurs par statut
$usersByStatus = [];
foreach ($users as $user) {
    $status = $user['STATUS_USER'] ?: 'Non défini';
    if (!isset($usersByStatus[$status])) {
        $usersByStatus[$status] = [];
    }
    $usersByStatus[$status][] = $user;
}

// Messages de notification
$successMessage = isset($_GET['success']) && isset($_GET['message']) ? $_GET['message'] : '';
$errorMessage = isset($_GET['error']) && isset($_GET['message']) ? $_GET['message'] : '';
?>
