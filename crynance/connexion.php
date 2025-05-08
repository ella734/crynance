<?php
// Connexion à la base de données (Modifie les paramètres selon ta configuration)
$host = 'localhost';
$db = 'crynance';
$user = 'root';
$pass = ''; // Mot de passe si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
