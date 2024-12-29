<?php
// Connexion à la base de données avec PDO
$username = 'root';
$password = "";
$servername = "localhost";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=carte", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec("set names utf8");
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Variables récupérées depuis le formulaire
$nom = $_POST['nom'] ?? "";
$prenom = $_POST['surname'] ?? "";
$dateNaissance = $_POST['dateNaissance'] ?? "";
$lieuNaissance = $_POST['lieuNaissance'] ?? "";
$adresse = $_POST['Adresse'] ?? "";

// Vérification que tous les champs sont remplis
if (!empty($nom) && !empty($prenom) && !empty($dateNaissance) && !empty($lieuNaissance) && !empty($adresse)) {
    try {
        // Préparation de la requête d'insertion
        $requete = $bdd->prepare("INSERT INTO utilisateur (nom, prenom, date_naissance, lieu_naissance, adresse) 
                                  VALUES (:nom, :prenom, :dateNaissance, :lieuNaissance, :adresse)");

        // Exécution de la requête avec les paramètres
        $requete->execute(array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':dateNaissance' => $dateNaissance,
            ':lieuNaissance' => $lieuNaissance,
            ':adresse' => $adresse
        ));

        echo ("<script>alert('Données enregistrées avec succès !');</script>");
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
} else {
    echo ("<script>alert('Veuillez remplir tous les champs !');</script>");
}
