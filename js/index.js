// Déclaration des variables
let inputName = document.getElementById("name");
let inputSurname = document.getElementById("surname");
let inputDateNaissance = document.getElementById("date");
let inputLieuNaissance = document.getElementById("lieu");
let inputAdresseResidence = document.getElementById("adresse");
let submitButton = document.getElementById("submitButton");
let resetButton = document.getElementById("resetButton");
let formulaireDeDonnee = document.getElementById("formulaireDeDonnee");
let carteContainer = document.querySelector(".carteContainer");
let formulaire = document.querySelector(".formulaire");

// Chargement des données de la page

// resetButton.addEventListener('click', () => {
//     formulaireDeDonnee.reset();
// });

// submitButton.addEventListener('click', () => {
//     carteContainer.style.display = "block";
//     formulaire.style.display = "none";
// });


// Fonction controlant le nom et le prénom 
const nameRegex = new RegExp("^[a-zA-Z'\\s-]{3,}$");
const surnameRegex = new RegExp("^[a-zA-Zéèêëàäïöüç\\s-]{3,}$");
const lieuNaissanceRegex = new RegExp("^[a-zA-Zéèêëàäïöüç\\s-]{3,}$");

inputName.addEventListener('input', validationName);
inputSurname.addEventListener('input', validationSurname);
inputDateNaissance.addEventListener('input', ValidateDateNaissance);
inputLieuNaissance.addEventListener('input', validationLieuNaissance);

// Fonction permettant la validation du nom
function validationName() {
    if (nameRegex.test(inputName.value)) {
        checkValidInput(inputName);
        return true;
    } else {
        checkErrorFalse(inputName);
        return false;
    }
}

// Fonction permettant la validation du prénom
function validationSurname() {
    if (surnameRegex.test(inputSurname.value)) {
        checkValidInput(inputSurname);
        return true;
    } else {
        checkErrorFalse(inputSurname);
        return false;
    }
}

// Fonction permettant la validation du lieu de naissance
function validationLieuNaissance() {
    if (lieuNaissanceRegex.test(inputLieuNaissance.value)) {
        checkValidInput(inputLieuNaissance);
        return true;
    } else {
        checkErrorFalse(inputLieuNaissance);
        return false;
    }
}

// Fonction permettant la validation de la date de naissance
function ValidateDateNaissance() {
    if (validationDate(inputDateNaissance.value)) {
        checkValidInput(inputDateNaissance);
        return true;
    } else {
        checkErrorFalse(inputDateNaissance);
        return false;
    }
}

function validationDate(date) {
    const newDate = new Date(date);
    return !isNaN(newDate.getTime()) && newDate.getFullYear() < 2008;
}

function checkErrorFalse(unValidInput) {
    unValidInput.classList.remove("validClass");
    unValidInput.classList.add("invalidClass");
    unValidInput.focus();
}

function checkValidInput(validInput) {
    validInput.classList.remove("invalidClass");
    validInput.classList.add("validClass");
}






// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Récupérer une image</title>
// </head>
// <body>
//     <a href="#" id="uploadLink">Cliquez ici pour sélectionner une image</a>
//     <input type="file" id="fileInput" accept="image/*" style="display: none;">
//     <br>
//     <img id="selectedImage" src="" alt="Votre image" style="display: none; max-width: 100%; height: auto;">

//     <script>
//         document.getElementById('uploadLink').addEventListener('click', function(event) {
//             event.preventDefault();
//             document.getElementById('fileInput').click();
//         });

//         document.getElementById('fileInput').addEventListener('change', function(event) {
//             const file = event.target.files[0];
//             if (file) {
//                 const reader = new FileReader();
//                 reader.onload = function(e) {
//                     const img = document.getElementById('selectedImage');
//                     img.src = e.target.result;
//                     img.style.display = 'block';
//                 };
//                 reader.readAsDataURL(file);
//             }
//         });
//     </script>
// </body>
// </html>



// <?php
// $servername = "localhost";
// $username = "root"; // Remplace par ton nom d'utilisateur MySQL
// $password = ""; // Remplace par ton mot de passe MySQL
// $dbname = "ma_base_de_donnees"; // Remplace par le nom de ta base de données

// // Créer une connexion
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Vérifier la connexion
// if ($conn->connect_error) {
//     die("Connexion échouée: " . $conn->connect_error);
// }

// // Récupérer les données du formulaire
// $name = $_POST['name'];
// $email = $_POST['email'];

// // Préparer et exécuter la requête SQL
// $sql = "INSERT INTO utilisateurs (name, email) VALUES ('$name', '$email')";

// if ($conn->query($sql) === TRUE) {
//     echo "Nouvel enregistrement créé avec succès";
// } else {
//     echo "Erreur: " . $sql . "<br>" . $conn->error;
// }

// // Fermer la connexion
// $conn->close();
// ?>












