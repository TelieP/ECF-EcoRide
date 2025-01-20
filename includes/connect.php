<?php
// Paramètres de connexion à la base de données
$host = 'localhost';      // Nom de l'hôte de la base de données (par exemple 'localhost' ou l'adresse IP du serveur)
$dbname = 'covoitbdd';   // Nom de la base de données
$username = 'root';        // Nom d'utilisateur MySQL
$password = '';            // Mot de passe MySQL (laissez vide si vous n'en avez pas)

// Connexion à la base de données avec PDO
try {
    // Créer une instance de PDO pour se connecter à la base de données
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Définir le mode d'erreur de PDO pour lancer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si la connexion réussit, afficher ce message
    echo "Connexion réussie!";
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur
    echo "Erreur de connexion : " . $e->getMessage();
    exit();  // Arrêter le script si la connexion échoue
}
