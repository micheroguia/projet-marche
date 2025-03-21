

<?php include '../config/conn_db.php';?>


<?php
   // verifions si la requtte est de type POST
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // on récupere dabord l;email envoyé par le formulaire
    // on nettoie ensuite avec filter_input pour eviter les caracteres dangereux

    $EMAIL = filter_input(INPUT_POST,'EMAIL',FILTER_SANITIZE_EMAIL);

    // ON REcupere le mot de passe envoyer pAR le formulaire
    // on verifie dabord si la case "password" existe deja dans $_POST  
        $PASSWORD = $_POST['PASSWORD'] ?? null;   
        

    // on s'assure que l'email et le mot de passe ne sont pas vides 
        if (!empty($EMAIL) && !empty($PASSWORD)){
    // ON Prepare une commande mysql pour chercher l'utlisateur qui a cet email
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE EMAIL = ?");
        
    // ON Lie la variable $EMAIL a la commande (le "s " est un string)
        $stmt->bind_param("s", $EMAIL);

    //on execute la commande 
        if ($stmt->execute()) {
    // on recupere les resultats de la commande 
        $result = $stmt->get_result();
    // on prend la premier ligne du resultat sous forme  de tableau associatif
        $user = $result->fetch_assoc();

        if(!$user) {
            echo"Aucun utlisateur trouver avec cet email";
            
            exit;
        }

    // on verifie que l;utlisateur esxiste et que le mot de passe correspond 
    // le mot de passe enregistrer est en base hacher donc on utiliseras password_verify

         if($PASSWORD === "$PASSWORD")
          {
    //ON demarre la session pour retenir qui est connecter
        session_start();

    // on enregistre les informations de l'utilisateurdans la session
        $_SESSION['ID_USER'] = $user['ID_USER'];
        $_SESSION['NAME_USER'] = $user['NAME_USER'];
        $_SESSION['ROLE'] = $user['ROLE'];

    // on redige la personne vers la parge "tablau_bord.php
    header("location: ../view/tableau_bord.php");
        exit();   //on arrete le script apres la redirection

        

         } 
        else{
    // si on n'a pas trouver l'utilisateur ,ou que le mot de passe est faux
        echo"Email ou mot de passe incorect";
        }

        }
         else{
    //si on la commande mysql nw s'est pas xecuter ,o affiche l;erreur 
        echo "Erreur d'execution : " . $stmt->error;    
         
        }

      }  else {
    //si l'email ou le mot de passe est vide ,on prvient l'utilisateur
        echo "Veullez remplir tous les champs";        
        }

         }
         else {
    //si on n;a pas recu la requete en methode PPOST ,on refuse l'acces
        echo "Methode non autorisée";        
        }


    
?>
