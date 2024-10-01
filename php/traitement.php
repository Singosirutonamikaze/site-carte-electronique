<?php
    //Envoyé les données du formulaire vers la table sql
    $username = "";
    $password = "";
    $servername = "localhost";
    
    // $bdd = new PDO("mysql:host=$servername;dbname=carte", $username, $password);
    // $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $bdd->exec("set names utf8");


    //variables
    $name = $_POST['name'] ?? "";
    $surname = $_POST['surname'] ?? "";
    $date = $_POST['date']??"";
    $lieu = $_POST['lieu']??"";
    $adresse = $_POST['adresse']??"";

    //Envoie des données suivant la condition if 
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['adresse'])) {
        
     }



