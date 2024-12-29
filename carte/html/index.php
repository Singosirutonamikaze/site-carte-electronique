<!-- Site web
Name : CarteElectronique
Author : SINGO Yao Dieu Donné
Date : 29/09/2024 -->

<?php
// Connexion à la base de données avec PDO
try {
    $bdd = new PDO("mysql:host=localhost;dbname=carte;charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo " <script>alert('Connexion réussie à la base de données !')</script>"; // Correction de Alert à alert
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


// Variables récupérées depuis le formulaire
$nom = $_POST['nom'] ?? "";
$prenom = $_POST['prenom'] ?? "";
$dateNaissance = $_POST['dateNaissance'] ?? "";
$lieuNaissance = $_POST['lieuNaissance'] ?? "";
$adresse = $_POST['Adresse'] ?? "";

//var_dump($nom, $prenom, $dateNaissance, $lieuNaissance, $adresse);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Les metas pour rendre la page responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre du site -->
    <title>CarteElectronique</title>

    <!-- Lien vers les fichiers CSS -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/carteSyle.css">
    <link rel="stylesheet" href="../css/carteFinale.css">
    <link rel="stylesheet" href="../css/voiture.css">

    <!-- Liens vers les polices et scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- lien vers les scripts -->
    <script src="../js/index.js" defer type="module"></script>
    <script src="../js/animation.js" defer type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
</head>

<body>
    <!-- Conteneur principal du formulaire et de l'affichage de la carte -->
    <div class="form">
        <!-- Section contenant les informations de la carte -->
        <div class="carteContainer" id="carteContainer" style="display: none;">
            <div class="parteOne">
                <div class="card__border"></div>
                <div class="tools">
                    <div class="circle">
                        <span class="red box"></span>
                    </div>
                    <div class="circle">
                        <span class="yellow box"></span>
                    </div>
                    <div class="circle">
                        <span class="green box"></span>
                    </div>
                </div>
                <!-- Champs à remplir automatiquement après soumission -->
                <div class="content">Nom : <span id="nameSpan"></span></div>
                <div class="content">Prénom : <span id="surnameSpan"></span></div>
                <div class="content">Date de Naissance : <span id="dateSpan"></span></div>
                <div class="content">Lieu de Naissance : <span id="lieuSpan"></span></div>
                <div class="content">Adresse : <span id="adresseSpan"></span></div>
            </div>
            <div class="parteTwo">
                <div class="card__border"></div>
                <div class="tools">
                    <div class="circle">
                        <span class="red box"></span>
                    </div>
                    <div class="circle">
                        <span class="yellow box"></span>
                    </div>
                    <div class="circle">
                        <span class="green box"></span>
                    </div>
                </div>
                <h1 id="codeSecret">0000 234 355 5689</h1>
                <div class="supplement">
                    <span id="codePersonnelle"></span>
                    <span id="Photo">
                        <!-- Formulaire pour télécharger une photo -->
                        <label class="custum-file-upload" for="file" id="labelupload">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <!-- SVG code d'un icône -->
                                    <path fill=""
                                        d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="text" title="Cliquer ici pour telecharger votre image">Clicker ici</div>
                            <input type="file" id="file" accept="image/*">
                            <!-- Acceptation des fichiers image -->
                        </label>
                        <img id="previewImage" />
                        <!-- Éléments pour afficher l'image -->
                    </span>
                </div>
            </div>

            <!-- Bouton pour finaliser -->
            <button id="finale">Finaliser</button>
        </div>

        <!-- Formulaire de saisie des données -->
        <div class="formulaire" id="formulaire">
            <div class="formcontainer">
                <form method="post" id="formulaireDeDonnee" name="formulaire" action="index.php">
                    <h1 class="title">Données de la carte</h1>

                    <!-- Entrée pour le nom -->
                    <div class="input">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" placeholder="E.g: ERIC" required>
                        <span id="nameError"></span>
                    </div>

                    <!-- Entrée pour le prénom -->
                    <div class="input">
                        <label for="surname">Prénom</label>
                        <input type="text" name="prenom" id="prenom" placeholder="E.g: Daniel" required>
                        <span id="surnameError"></span>
                    </div>

                    <!-- Entrée pour la date de naissance -->
                    <div class="input">
                        <label for="dateNaissance">Date de Naissance</label>
                        <input type="date" name="dateNaissance" id="dateNaissance" required>
                        <span id="dateError"></span>
                    </div>

                    <!-- Entrée pour le lieu de naissance -->
                    <div class="input">
                        <label for="lieuNaissance">Lieu de Naissance</label>
                        <input type="text" name="lieuNaissance" id="lieuNaissance" placeholder="E.g: Luxembourg"
                            required>
                        <span id="lieuError"></span>
                    </div>

                    <!-- Entrée pour l'adresse -->
                    <div class="input">
                        <label for="Adresse">Adresse de résidence</label>
                        <input type="text" name="Adresse" id="Adresse" placeholder="E.g: TOGO, Lomé, Maritime" required>
                        <span id="adresseError"></span>
                    </div>

                    <!-- Boutons pour réinitialiser et envoyer le formulaire -->
                    <div class="inputSutbmi">
                        <input type="reset" value="Réinitialiser" id="resetButton">
                        <input type="submit" value="Envoyer" id="submitButton">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="carteFinale" id="carteFinale">
        <div class="voiture">
            <div class="voiture__body">
                <div class="voiture__body voiture__body--top">
                    <div class="voiture__window">
                        <div class="voiture__window-glass"></div>
                    </div>
                </div>
                <div class="voiture__body voiture__body--mid">
                    <div class="voiture__mid-body"></div>
                </div>
                <div class="voiture__body voiture__body--bottom">
                    <div class="voiture__underpanel"></div>
                    <div class="voiture__rear-bumper"></div>
                    <div class="voiture__side-skirt"></div>
                </div>
            </div>
            <div class="voiture__wheel voiture__wheel--front">
                <div class="voiture__wheel-arch"></div>
                <div class="voiture__wheel-arch-trim voiture__wheel-arch-trim--top"></div>
                <div class="voiture__wheel-arch-trim voiture__wheel-arch-trim--left"></div>
                <div class="voiture__wheel-arch-trim voiture__wheel-arch-trim--right"></div>
                <div class="voiture-wheel">
                    <div class="voiture-wheel__rim">
                        <div style="--index: 0;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 1;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 2;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 3;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 4;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 5;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 6;" class="voiture-wheel__spoke"></div>
                    </div>
                </div>
            </div>
            <div class="voiture__wheel voiture__wheel--rear">
                <div class="voiture__wheel-arch"></div>
                <div class="voiture__wheel-arch-trim voiture__wheel-arch-trim--top"></div>
                <div class="voiture__wheel-arch-trim voiture__wheel-arch-trim--left"></div>
                <div class="voiture__wheel-arch-trim voiture__wheel-arch-trim--right"></div>
                <div class="voiture-wheel">
                    <div class="voiture-wheel__rim">
                        <div style="--index: 0;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 1;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 2;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 3;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 4;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 5;" class="voiture-wheel__spoke"></div>
                        <div style="--index: 6;" class="voiture-wheel__spoke"></div>
                    </div>
                </div>
            </div>
            <div class="voiture__headlight"></div>
            <div class="voiture__taillight"></div>
            <div class="voiture__indicator"></div>
            <div class="voiture__foglight"></div>
        </div>
    </div>
    <div class="presentation" id="presentation">
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <div class="content">Nom : <span id="nameSpanB"></span></div>
                    <div class="content">Prénom : <span id="surnameSpanB"></span></div>
                    <div class="content">Date de Naissance : <span id="dateSpanB"></span></div>
                    <div class="content">Lieu de Naissance : <span id="lieuSpanB"></span></div>
                    <div class="content">Adresse : <span id="adresseSpanB"></span></div>
                </div>
                <div class="card-back">
                    <div class="supplementB">
                        <div class="logoContainer">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="23" height="23"
                                viewBox="0 0 48 48" class="svgLogo">
                                <path fill="#ff9800" d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z"></path>
                                <path fill="#d50000" d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z"></path>
                                <path fill="#ff3d00"
                                    d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <h1 id="codeSecret">XXXX XXXX XXXX XXXX</h1>
                    <div class="prompt-id567"
                        style="margin-top: 2%; width: 100%; box-sizing: border-box; display: flex; justify-content: space-between; padding: 5%;">
                        <div class="token-container">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="50"
                                width="50">
                                <path fill="url(#paint0_linear_713_51)"
                                    d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18V18ZM10 5.05L14.95 10L10 14.95L5.05 10L10 5.05V5.05ZM10 7.879L7.879 10L10 12.121L12.121 10L10 7.879V7.879Z">
                                </path>
                                <defs>
                                    <linearGradient gradientUnits="userSpaceOnUse" y2="22.6007" x2="16.4204" y1="0"
                                        x1="0" id="paint0_linear_713_51">
                                        <stop stop-color="#AF40FF"></stop>
                                        <stop stop-color="#5B42F3" offset="0.5"></stop>
                                        <stop stop-color="#00DDEB" offset="1"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="token-container">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="50"
                                width="50">
                                <path fill="url(#paint0_linear_713_51)"
                                    d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18V18ZM10 5.05L14.95 10L10 14.95L5.05 10L10 5.05V5.05ZM10 7.879L7.879 10L10 12.121L12.121 10L10 7.879V7.879Z">
                                </path>
                                <defs>
                                    <linearGradient gradientUnits="userSpaceOnUse" y2="22.6007" x2="16.4204" y1="0"
                                        x1="0" id="paint0_linear_713_51">
                                        <stop stop-color="#AF40FF"></stop>
                                        <stop stop-color="#5B42F3" offset="0.5"></stop>
                                        <stop stop-color="#00DDEB" offset="1"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="token-container">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="50"
                                width="50">
                                <path fill="url(#paint0_linear_713_51)"
                                    d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18V18ZM10 5.05L14.95 10L10 14.95L5.05 10L10 5.05V5.05ZM10 7.879L7.879 10L10 12.121L12.121 10L10 7.879V7.879Z">
                                </path>
                                <defs>
                                    <linearGradient gradientUnits="userSpaceOnUse" y2="22.6007" x2="16.4204" y1="0"
                                        x1="0" id="paint0_linear_713_51">
                                        <stop stop-color="#AF40FF"></stop>
                                        <stop stop-color="#5B42F3" offset="0.5"></stop>
                                        <stop stop-color="#00DDEB" offset="1"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="token-container">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="50"
                                width="50">
                                <path fill="url(#paint0_linear_713_51)"
                                    d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18V18ZM10 5.05L14.95 10L10 14.95L5.05 10L10 5.05V5.05ZM10 7.879L7.879 10L10 12.121L12.121 10L10 7.879V7.879Z">
                                </path>
                                <defs>
                                    <linearGradient gradientUnits="userSpaceOnUse" y2="22.6007" x2="16.4204" y1="0"
                                        x1="0" id="paint0_linear_713_51">
                                        <stop stop-color="#AF40FF"></stop>
                                        <stop stop-color="#5B42F3" offset="0.5"></stop>
                                        <stop stop-color="#00DDEB" offset="1"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>