document.getElementById("login-form").addEventListener("submit", function (event) {
    var email = document.getElementById("email").value;
    var motdepasse = document.getElementById("motdepasse").value;

    if (!email || !motdepasse) {
        alert("Both fields are required.");
        event.preventDefault(); // Empêche l'envoi du formulaire
    }
});
