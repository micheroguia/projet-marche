<?php include '../config/conn_db.php';?>


<?php

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $NAME_USER = $_POST['NAME_USER'];
    $EMAIL = $_POST['EMAIL'];
    $PASSWORD = $_POST['PASSWORD'];
    $ROLE = $_POST['ROLE'];
    $STATUS_USER = $_POST['STATUS_USER'];
 

    // ajout du achage du mot de passe

    //  $PASSWORD = password_hash($PASSWORD,PASSWORD_DEFAULT);

    if (!empty ($NAME_USER) && !empty($EMAIL) && !empty($PASSWORD) && !empty($ROLE) && !empty($STATUS_USER)){
        $stmt = $conn->prepare("INSERT INTO utilisateurs (NAME_USER, EMAIL, PASSWORD, ROLE, STATUS_USER) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss", $NAME_USER, $EMAIL, $PASSWORD, $ROLE, $STATUS_USER);
       
        if($stmt->execute()){
            echo("enregistrement reussi");
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