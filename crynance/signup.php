<?php
session_start();
include 'connexion.php'; // Connexion à la base de données

// Si le formulaire d'inscription est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $erreur = "Cet email est déjà utilisé.";
    } else {
        // Insérer l'utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, motdepasse) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $motdepasse]);
        
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['nom'] = $nom;
        header('Location: mainpage.php'); // Redirection vers la page principale après inscription
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Crynance</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>

    <header>
        <nav>
            <div class="logo">Crynance</div>
            <ul>
                <li><a href="#">Markets</a></li>
                <li><a href="#">Trade</a></li>
                <li><a href="index.php">Login</a></li> <!-- Lien vers la page de connexion -->
                <li><a href="signup.php" class="active">Sign Up</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="signup-section">
            <h1>Create an Account</h1>
            <p>Please enter your details to sign up:</p>

            <?php if (!empty($erreur)) : ?>
                <p style="color: red;"><?= htmlspecialchars($erreur) ?></p>
            <?php endif; ?>

            <!-- Formulaire d'inscription -->
            <form method="POST" action="signup.php">
                <label for="nom">Name:</label>
                <input type="text" id="nom" name="nom" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="motdepasse">Password:</label>
                <input type="password" id="motdepasse" name="motdepasse" required>

                <button type="submit">Sign Up</button>
            </form>

            <p>Already have an account? <a href="index.php">Login</a></p> <!-- Lien vers index.php -->
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Crynance. All rights reserved.</p>
    </footer>

</body>
</html>
