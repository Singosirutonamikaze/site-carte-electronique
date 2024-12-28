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
    echo("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Variables récupérées depuis le formulaire
$nom = $_POST['nom'] ?? "";
$prenom = $_POST['surname'] ?? "";
$dateNaissance = $_POST['dateNaissance'] ?? "";
$lieuNaissance = $_POST['lieuNaissance'] ?? "";
$adresse = $_POST['Adresse'] ?? "";

// Vérification que tous les champs sont remplis
if (!empty($nom) && !empty($prenom) && !empty($dateNaissance) && !empty($lieuNaissance) && !empty($adresse)) {
    // Préparation de la requête d'insertion
    $requete = $bdd->prepare("INSERT INTO carte (nom, prenom, date_naissance, lieu_naissance, adresse) 
                              VALUES (:nom, :prenom, :dateNaissance, :lieuNaissance, :adresse)");

    // Liaison des paramètres
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':dateNaissance', $dateNaissance);
    $requete->bindParam(':lieuNaissance', $lieuNaissance);
    $requete->bindParam(':adresse', $adresse);

    // Exécution de la requête
    if ($requete->execute()) {
        echo ("<script>alert('Données enregistées avec succès !');</script>");
    } else {
        echo "Une erreur est survenue : " . $requete->errorInfo()[2];
    }
} else {
    echo ("<script>alert('Veuillez remplir tous les champs !');</script>");
}
