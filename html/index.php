<!-- Site web
Name :CarteElectronique
Author : SINGO Yao Dieu Donné
Date : 11/07/2024-->
<?php




?>


<!DOCTYPE html>

<html lang="en">
<!-- En tête du site web -->

<head>
    <!-- Les metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre du site -->
    <title>CarteElectronique</title>

    <!-- Liens vers les styles -> Utilisation du css -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/carteSyle.css">

    <!-- Lien vers les scripts -->
    <script src="../js/index.js" defer></script>

    <!--font family-->
    <link rel="import" href="https://www.frontendmentor.io/pro?ref=style-guide">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>
<!-- Corps du site web (Ce qui apparait à utilisateur) -->

<body>
    <div class="form">
        <div class="carteContainer">
            <div class="parteOne">
                <div class="content">Nom : <span id="name"></span></div>
                <div class="content">Prénom : <span id="prenom"></span></div>
                <div class="content">Date de Naissance : <span id="date"></span></div>
                <div class="content">Lieu de Naissance : <span id="lieu"></span></div>
                <div class="content">Adresse : <span id="adresse"></span></div>
            </div>
            <div class="parteTwo">
               <h1>0000 0000 0000 0000</h1>
                <div class="supplement">
                    <span id="codePersonnelle"></span>
                    <span id="Photo"><a href="#">+</a></span>
                </div>
            </div>

            <button id="finale">Finaliser</button>
        </div>
        <div class="formulaire" id="formulaire">
            <div class="formcontainer">
                <form action="index.php" method="post" id="formulaireDeDonnee">
                    <h1>Données de la carte</h1>
                    <div class="input">
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" title="Cher utilisateur veuillez entrer votre nom" placeholder="E.g: ERIC">
                    </div>
                    <div class="input">
                        <label for="surname">Prénom</label>
                        <input type="text" name="surname" id="surname" title="Cher utilisateur veuillez entrer votre prénom" placeholder="E.g: daniel">
                    </div>
                    <div class="input">
                        <label for="date">Date de Naissance</label>
                        <input type="date" name="date" id="date" title="Cher utilisateur veuillez entrer votre date de naissance" placeholder="23/12/2021">
                    </div>
                    <div class="input">
                        <label for="lieu">Lieu de Naissance</label>
                        <input type="text" name="lieu" id="lieu" title="Cher utilisateur veuillez entrer votre Lieu de naissance" placeholder="E.g: Luxembourg">
                    </div>
                    <div class="input">
                        <label for="adresse">Adresse de résidence</label>
                        <input type="text" name="adresse" id="adresse" title="Cher utilisateur veuillez entrer votre adresse de residence" placeholder="E.g: New york">
                    </div>
                    <div class="inputSutbmi">
                        <input type="reset" value="Recommencer" id="resetButton">
                        <input type="submit" value="Envoyer" id="submitButton">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>