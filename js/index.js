// Déclaration des variables
let submitButton = document.getElementById("submitButton");
let resetButton = document.getElementById("resetButton");
let formulaireDeDonnee = document.getElementById("formulaireDeDonnee");
let carteContainer = document.querySelector(".carteContainer");
let formulaire = document.querySelector(".formulaire");

// Chargement des données de la page
resetButton.addEventListener('click', () => {
    formulaireDeDonnee.reset();
});

submitButton.addEventListener('click', () => {
    if (ValidationFormulaire()) {
        formulaire.style.display = "none";
        carteContainer.style.display = "block";
    }
});

function ValidationFormulaire() {
    // Variables locales
    let inputName = document.getElementById("name").value.trim();
    let inputSurname = document.getElementById("surname").value.trim();
    let inputDateNaissance = document.getElementById("date").value.trim();
    let inputLieuNaissance = document.getElementById("lieu").value.trim();
    let inputAdresseResidence = document.getElementById("adresse").value.trim();

    // Réinitialisation des valeurs des erreurs à une valeur nulle
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("surnameError").innerHTML = "";
    document.getElementById("dateError").innerHTML = "";
    document.getElementById("lieuError").innerHTML = "";
    document.getElementById("adresseError").innerHTML = "";

    // Déclaration des regex
    var nameRegex = new RegExp("^[a-zA-Z'\\s-]{3,}$");
    var surnameRegex = new RegExp("^[a-zA-Zéèêëàäïöüç\\s-]{3,}$");
    var lieuRegex = new RegExp("^[a-zA-Zéèêëàäïöüç\\s-]{3,}$");
    var adresseRegex = new RegExp("^[a-zA-Zéèêëàäïöüç\\s-]{3,}$");

    // Validation des divers champs
    if (inputName === "") {
        document.getElementById("nameError").innerHTML = "Veuillez réécrire votre nom.";
        return false;
    } else {
        if (!nameRegex.test(inputName)) {
            document.getElementById("nameError").innerHTML = "Les caractères utilisés ne sont pas corrects.";
            return false;
        }
    }

    if (inputSurname === "") {
        document.getElementById("surnameError").innerHTML = "Veuillez respecter les caractères de votre prénom.";
        return false;
    } else {
        if (!surnameRegex.test(inputSurname)) {
            document.getElementById("surnameError").innerHTML = "Veuillez respecter les caractères de votre prénom.";
            return false;
        }
    }

    if (inputDateNaissance === "") {
        document.getElementById("dateError").innerHTML = "Vous devez avoir au moins 16 ans.";
        return false;
    }

    if (inputLieuNaissance === "") {
        document.getElementById("lieuError").innerHTML = "Veuillez entrer votre lieu de naissance.";
        return false;
    } else {
        if (!lieuRegex.test(inputLieuNaissance)) {
            document.getElementById("lieuError").innerHTML = "Veuillez respecter les caractères de votre lieu de naissance.";
            return false;
        }
    }

    if (inputAdresseResidence === "") {
        document.getElementById("adresseError").innerHTML = "Veuillez entrer votre adresse actuelle.";
        return false;
    } else {
        if (!adresseRegex.test(inputAdresseResidence)) {
            document.getElementById("adresseError").innerHTML = "Veuillez respecter l'adresse de votre résidence.";
            return false;
        }
    }

    return true;
}
