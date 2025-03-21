<?php include '../config/conn_db.php';?>


<?php

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $NOM_PROJET = $_POST['name'];
    $DESCRIPTION_PROJET= $_POST['description'];
    $STATUT_PROJET = $_POST['status'];
    $DATE_DEBUT_PROJET = $_POST['start_date'];
    $DATE_FIN_PROJET = $_POST['end_date'];
    $PRIORITER = $_POST['priority'];
    $BUDJET = $_POST['budget'];
 

    // ajout du achage du mot de passe

    //  $PASSWORD = password_hash($PASSWORD,PASSWORD_DEFAULT);

    if (!empty( $NOM_PROJET) && !empty($DESCRIPTION_PROJET) && !empty( $STATUT_PROJET) && !empty($PRIORITER) && !empty( $DATE_DEBUT_PROJET) && !empty( $DATE_FIN_PROJET) && !empty(  $BUDJET )){
        $stmt = $conn->prepare("INSERT INTO projet (NOM_PROJET, DESCRIPTION_PROJET, STATUT_PROJET, PRIORITER, DATE_DEBUT_PROJET, DATE_FIN_PROJET, BUDJET ) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $NOM_PROJET, $DESCRIPTION_PROJET,  $STATUT_PROJET, $PRIORITER, $DATE_DEBUT_PROJET, $DATE_FIN_PROJET, $BUDJET );
       
        if($stmt->execute()){
            echo"<script> alert ('projet ajouter avec succes') <\script>";
        } else{
            echo("erreur " . $stmt->error);
        }
// pour fermer la session
        $stmt->close();
        $conn->close();
      

    } else{
        echo("erreur " );
    }


}

?>