<?php
session_start(); // Démarre la session

// Si l'utilisateur est déjà connecté, redirige vers la page principale
if (isset($_SESSION['user_id'])) {
    header('Location: mainpage.php');
    exit();
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données
    include 'connexion.php';

    // Récupérer les informations envoyées par le formulaire
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    // Vérification de l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérification des identifiants
    if ($user && password_verify($motdepasse, $user['motdepasse'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];

        // Redirection vers la page principale
        header('Location: mainpage.php');
        exit();
    } else {
        $erreur = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Crynance</title>
    <link rel="stylesheet" href="login.css">
    <script src="login.js" defer></script>
</head>
<body>
    <div class="login-container">
        <h1>Login to Crynance</h1>

        <?php if (!empty($erreur)) : ?>
            <p class="error"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <form id="login-form" method="POST" action="index.php">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="motdepasse">Password:</label>
                <input type="password" id="motdepasse" name="motdepasse" required>
            </div>

            <button type="submit" id="login-button">Login</button>

            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </form>
    </div>
</body>
</html>
