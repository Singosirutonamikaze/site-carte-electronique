let finale = document.getElementById("finale");
let PagePresentation = document.getElementById("presentation");
let carteFinale = document.getElementById("carteFinale");
let carteContainer = document.getElementById("carteContainer");

finale.addEventListener("click", function () {
    // Afficher la carte terminée avec une petite animation
    carteContainer.style.display = "none";  // Cache la carte principale
    carteFinale.style.display = "flex";     // Affiche la carte finale

    // Après 4 secondes, cacher la carte finale et afficher la page de présentation
    setTimeout(function () {
        carteFinale.style.display = "none";  
        PagePresentation.style.display = "flex";  

        // Vérifier si le formulaire est validé avant d'afficher les données
        if (ValidationFormulaire()) {
            afficherDonnees();     
        }
    }, 4000); // 4000 ms = 4 secondes
});

// Fonction pour valider le formulaire
function ValidationFormulaire() {
    const formFields = [
        document.getElementById("nom").value,
        document.getElementById("prenom").value,
        document.getElementById("dateNaissance").value,
        document.getElementById("lieuNaissance").value,
        document.getElementById("Adresse").value
    ];

    return formFields.every(field => field.trim() !== ""); // Vérifie que tous les champs sont remplis
}

// Fonction pour afficher les données dans la carte
function afficherDonnees() {
    const nameSpan = document.getElementById("nameSpanB");
    const surnameSpan = document.getElementById("surnameSpanB");
    const dateSpan = document.getElementById("dateSpanB");
    const lieuSpan = document.getElementById("lieuSpanB");
    const adresseSpan = document.getElementById("adresseSpanB");

    // Met à jour les éléments de la présentation
    nameSpan.innerHTML = document.getElementById("nom").value;
    surnameSpan.innerHTML = document.getElementById("prenom").value;
    dateSpan.innerHTML = document.getElementById("dateNaissance").value;
    lieuSpan.innerHTML = document.getElementById("lieuNaissance").value;
    adresseSpan.innerHTML = document.getElementById("Adresse").value;
}


