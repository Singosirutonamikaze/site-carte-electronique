// Sélection des éléments du DOM
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

// Validation et soumission du formulaire
submitButton.addEventListener('click', (event) => {
    event.preventDefault(); // Empêcher le comportement par défaut
    clearErrors(); // Nettoyer les messages d'erreurs avant chaque validation

    if (ValidationFormulaire()) {
        formulaire.style.display = "none";
        carteContainer.style.display = "flex";
        afficherDonnees();
        createQrCode();
    }
});

// Fonction de validation du formulaire
function ValidationFormulaire() {
    // Récupération des valeurs des champs
    const inputName = document.getElementById("nom").value.trim();
    const inputSurname = document.getElementById("surname").value.trim();
    const inputDateNaissance = document.getElementById("dateNaissance").value.trim();
    const inputLieuNaissance = document.getElementById("lieuNaissance").value.trim();
    const inputAdresseResidence = document.getElementById("Adresse").value.trim();

    // Variables pour suivre l'état des validations
    let isValid = true;

    // Expressions régulières pour validation
    const nameRegex = /^[a-zA-Z\s-]{3,}$/;
    const surnameRegex = /^[a-zA-Zéèêëàäïöüç\s-]{3,}$/;
    const lieuRegex = /^[a-zA-Zéèêëàäïöüç\s-]{3,}$/;
    const adresseRegex = /^[a-zA-Zéèêëàäïöüç\s-]{3,}$/;

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
        const moisDifference = today.getMonth() - birthDate.getMonth();

        // Vérification si l'anniversaire a déjà eu lieu cette année
        if (moisDifference < 0 || (moisDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

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
const inputFields = [
    "nom",
    "surname",
    "dateNaissance",
    "lieuNaissance",
    "Adresse"
];

inputFields.forEach(fieldId => {
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

//Affichage des données saisie dans le formulaire sur la carte
function afficherDonnees() {
    //Déclaration des variables
    const nameSpan = document.getElementById("nameSpan");
    const surnameSpan = document.getElementById("surnameSpan");
    const dateSpan = document.getElementById("dateSpan");
    const lieuSpan = document.getElementById("lieuSpan");
    const adresseSpan = document.getElementById("adresseSpan");

    //Affichage des données saisies
    nameSpan.innerHTML = `${document.getElementById("nom").value}`;
    surnameSpan.innerHTML = `${document.getElementById("surname").value}`;
    dateSpan.innerHTML = `${document.getElementById("dateNaissance").value}`;
    lieuSpan.innerHTML = `${document.getElementById("lieuNaissance").value}`;
    adresseSpan.innerHTML = `${document.getElementById("Adresse").value}`;
}

// Création du code QR
function createQrCode() {
    // Déclaration des variables
    const qrContent = `${document.getElementById("nom").value} + ${document.getElementById("surname").value} + ${document.getElementById("dateNaissance").value} + ${document.getElementById("lieuNaissance").value} + ${document.getElementById("Adresse").value}`;
    $('#codePersonnelle').empty(); // Vider le contenu précédent
    $('#codePersonnelle').qrcode({ width: 250, height: 125, text: qrContent }); // Générer le code QR
}

//Télécharger une image sur la carte
function TelechargerImage() {
    document.getElementById("file").addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
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



