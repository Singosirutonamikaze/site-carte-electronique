document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments du DOM ici
    const submitButton = document.getElementById("submitButton");
    const resetButton = document.getElementById("resetButton");
    const formulaireDeDonnee = document.getElementById("formulaireDeDonnee");
    const carteContainer = document.getElementById("carteContainer");
    const formulaire = document.getElementById("formulaire");

    // Réinitialisation du formulaire
    resetButton.addEventListener('click', () => {
        formulaireDeDonnee.reset();
        clearErrors(); // Réinitialisation des erreurs
    });

    // Validation et soumission du formulaire avec AJAX
    submitButton.addEventListener('click', (event) => {
        event.preventDefault(); // Empêcher le comportement par défaut
        clearErrors(); // Nettoyer les messages d'erreurs avant chaque validation

        if (ValidationFormulaire()) {
            formulaire.style.display = "none";
            carteContainer.style.display = "flex";
            afficherDonnees();
            createQrCode();
            document.getElementById("codeSecret").textContent = GenerateurChiffre();

            // Envoi des données au serveur via AJAX
            let formData = new FormData(formulaireDeDonnee);
            fetch('index.php', { // Envoi au même fichier index.php
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    console.log('Success:', data);
                    alert("Données enregistrées avec succès !");
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert("Une erreur est survenue.");
                });
        }
    });

    /**
     * Fonction de validation du formulaire
     * @returns {boolean} vrai si la validation réussit, faux sinon
     */
    function ValidationFormulaire() {
        // Récupération des valeurs des champs
        const inputName = document.getElementById("nom").value.trim();
        const inputSurname = document.getElementById("prenom").value.trim();
        const inputDateNaissance = document.getElementById("dateNaissance").value.trim();
        const inputLieuNaissance = document.getElementById("lieuNaissance").value.trim();
        const inputAdresseResidence = document.getElementById("Adresse").value.trim();

        // Variables pour suivre l'état des validations
        let isValid = true;

        // Expressions régulières pour validation
        const nameRegex = new RegExp(/^[a-zA-Z\s-]{3,}$/);
        const surnameRegex = new RegExp(/^[a-zA-Zéèêëàäïöüç\s-]{3,}$/);
        const lieuRegex = new RegExp(/^[a-zA-Zéèêëàäïöüç\s-]{3,}$/);
        const adresseRegex = new RegExp(/^[a-zA-Z0-9À-ÿ\s,]+$/);

        // Validation des différents champs
        if (!nameRegex.test(inputName)) {
            displayError("nameError", "Veuillez saisir un nom valide.");
            isValid = false;
        }

        if (!surnameRegex.test(inputSurname)) {
            displayError("surnameError", "Veuillez saisir un prénom valide.");
            isValid = false;
        }

        if (inputDateNaissance === "") {
            displayError("dateError", "Veuillez entrer une date de naissance.");
            isValid = false;
        } else {
            const birthDate = new Date(inputDateNaissance);
            const today = new Date();

            // Calcul de l'âge
            const age = today.getFullYear() - birthDate.getFullYear();

            // Vérification de l'âge
            if (age < 18) {
                displayError("dateError", "Vous devez avoir 18 ans et plus.");
                isValid = false;
            }
        }

        if (!lieuRegex.test(inputLieuNaissance)) {
            displayError("lieuError", "Veuillez saisir un lieu de naissance valide.");
            isValid = false;
        }

        if (!adresseRegex.test(inputAdresseResidence)) {
            displayError("adresseError", "Veuillez saisir une adresse valide.");
            isValid = false;
        }

        return isValid; // Retourne vrai si toutes les validations réussissent
    }

    /**
     * Fonction pour afficher une erreur
     * @param {string} elementId ID de l'élément HTML qui affichera l'erreur
     * @param {string} message Message d'erreur
     */
    function displayError(elementId, message) {
        document.getElementById(elementId).innerHTML = message;
    }

    /**
     * Fonction pour réinitialiser les erreurs.
     * 
     * @description Cette fonction nettoie les messages d'erreur qui ont été affichés
     *              pour les différents champs du formulaire.
     */
    function clearErrors() {
        /**
         * Nets les erreurs pour le champ nom
         */
        document.getElementById("nameError").innerHTML = "";
        /**
         * Nets les erreurs pour le champ prénom
         */
        document.getElementById("surnameError").innerHTML = "";
        /**
         * Nets les erreurs pour le champ date de naissance
         */
        document.getElementById("dateError").innerHTML = "";
        /**
         * Nets les erreurs pour le champ lieu de naissance
         */
        document.getElementById("lieuError").innerHTML = "";
        /**
         * Nets les erreurs pour le champ adresse de résidence
         */
        document.getElementById("adresseError").innerHTML = "";
    }


    [
        "nom",
        "prenom",
        "dateNaissance",
        "lieuNaissance",
        "Adresse"
    ].forEach(function (fieldId) {
        const inputField = document.getElementById(fieldId);
        inputField.addEventListener('input', () => {
            clearError();
        });
    });

    /**
     * Fonction pour nettoyer l'erreur d'un champ spécifique
     * @param {string} fieldId ID de l'élément HTML du champ
     */
    function clearError() {
        document.getElementById(fieldId).innerHTML = "";
    }

    // Fonction pour afficher une erreur
    function displayError(elementId, message) {
        document.getElementById(elementId).innerHTML = message;
    }

    // Fonction pour réinitialiser les erreurs
    function clearErrors() {
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("surnameError").innerHTML = "";
        document.getElementById("dateError").innerHTML = "";
        document.getElementById("lieuError").innerHTML = "";
        document.getElementById("adresseError").innerHTML = "";
    }

    // Ajout d'écouteurs d'événements pour nettoyer les erreurs lors de la saisie

    [
        "nom",
        "prenom",
        "dateNaissance",
        "lieuNaissance",
        "Adresse"
    ].forEach(function (fieldId) {
        const inputField = document.getElementById(fieldId);
        inputField.addEventListener('input', () => {
            clearError();
        });
    });

    // Fonction pour nettoyer l'erreur d'un champ spécifique
    function clearError() {
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("surnameError").innerHTML = "";
        document.getElementById("dateError").innerHTML = "";
        document.getElementById("lieuError").innerHTML = "";
        document.getElementById("adresseError").innerHTML = "";
    }

    /**
     * Affichage des données saisies dans le formulaire sur la carte
     * 
     * @description Cette fonction récupère les valeurs des champs de formulaire
     *              et les affiche sur la carte.
     */
    function afficherDonnees() {
        // Déclaration des variables
        const nameSpan = document.getElementById("nameSpan");
        const surnameSpan = document.getElementById("surnameSpan");
        const dateSpan = document.getElementById("dateSpan");
        const lieuSpan = document.getElementById("lieuSpan");
        const adresseSpan = document.getElementById("adresseSpan");

        // Affichage des données saisies
        nameSpan.innerHTML = `${document.getElementById("nom").value}`;
        surnameSpan.innerHTML = `${document.getElementById("prenom").value}`;
        dateSpan.innerHTML = `${document.getElementById("dateNaissance").value}`;
        lieuSpan.innerHTML = `${document.getElementById("lieuNaissance").value}`;
        adresseSpan.innerHTML = `${document.getElementById("Adresse").value}`;
    }

    /**
     * Création du code QR
     * 
     * @description Cette fonction crée un code QR avec les données saisies
     *              dans le formulaire. Le code QR est affiché sur la carte.
     * @param {String} content Le contenu du code QR
     */
    function createQrCode() {
        const qrContent = `
            ${document.getElementById("nom").value} + 
            ${document.getElementById("prenom").value} + 
            ${document.getElementById("dateNaissance").value} + 
            ${document.getElementById("lieuNaissance").value} + 
            ${document.getElementById("Adresse").value}
        `;

        // Sélection de la div qui contiendra le QR code
        const qrContainer = document.getElementById('codePersonnelle');
        qrContainer.innerHTML = ''; // Vider le contenu précédent

        // Obtenir la largeur et hauteur de la div parente
        const containerWidth = qrContainer.offsetWidth;
        const containerHeight = qrContainer.offsetHeight;

        // Générer le QR code avec des dimensions correspondant à 100% de la div parente
        $(qrContainer).qrcode({
            width: containerWidth,
            height: containerHeight,
            text: qrContent
        });
    }


    /**
     * Télécharger une image sur la carte
     * 
     * @description Cette fonction ajoute un événement d'écoute sur le champ de
     *              téléchargement de fichier. Lorsque le fichier est téléchargé,
     *              la fonction lit le fichier avec FileReader et affiche
     *              l'image sur la carte.
     */
    function TelechargerImage() {
        document.getElementById("file").addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                // Lorsque le fichier est lu, exécuter la fonction ci-dessous
                reader.onload = function (e) {
                    // Afficher l'image sur la carte
                    const imageUpload = document.getElementById('labelupload');
                    const img = document.getElementById('previewImage');
                    img.src = e.target.result; // Définir la source de l'image sur le résultat du FileReader
                    img.style.display = 'block'; // Afficher l'image
                    imageUpload.style.display = 'none';
                }
                reader.readAsDataURL(file); // Lire le fichier comme une URL de données
            }
        });
    }

    // Appel de la fonction pour le telechargement de l'image
    TelechargerImage();

    /**
     * Génère un code personnel aléatoire
     * @returns {string} Un code personnel de 14 chiffres aléatoires
     */
    function GenerateurChiffre() {
        let numbers = '';
        for (let i = 0; i < 14; i++) {
            numbers += Math.floor(Math.random() * 11); // Génère un chiffre aléatoire entre 0 et 9
        }
        return numbers; // Utiliser le résultat de ajouterEspaces
    }

});


