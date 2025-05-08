// Fonction pour valider le formulaire d'inscription
function validateForm() {
    // Récupérer les valeurs des champs
    var nom = document.getElementById("nom").value;
    var email = document.getElementById("email").value;
    var motdepasse = document.getElementById("motdepasse").value;
    
    // Vérification que le nom n'est pas vide
    if (nom === "") {
        alert("Le nom est obligatoire.");
        return false;
    }

    // Vérification que l'email n'est pas vide et a un format valide
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email === "") {
        alert("L'email est obligatoire.");
        return false;
    } else if (!emailPattern.test(email)) {
        alert("Veuillez entrer un email valide.");
        return false;
    }

    // Vérification que le mot de passe n'est pas vide et respecte la longueur minimale
    if (motdepasse === "") {
        alert("Le mot de passe est obligatoire.");
        return false;
    } else if (motdepasse.length < 6) {
        alert("Le mot de passe doit comporter au moins 6 caractères.");
        return false;
    }

    // Si toutes les vérifications sont passées, soumettre le formulaire
    return true;
}
