<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "startup";

    $conn = new mysqli($host, $username, $password, $dbname);

        if($conn->connect_error){
            die("Erreur de connection " . $conn->connect_error);
}



?> 