<?php
session_start();

// Connexion à la base de données
require_once('../includes/connect.php');
require_once('../includes/header.php');

// Vérification de la session utilisateur (l'utilisateur doit être connecté)
// if (!isset($_SESSION['user_id'])) {
//     die("Veuillez vous connecter pour réserver.");
// }
// var_dump($_GET);
// Récupérer l'ID du trajet à réserver
if (!isset($_GET['id'])) {
    die("ID de trajet manquant.");
}

$cov_id = $_GET['Id_covoiturage'];

// Récupérer les informations du trajet
$sql = "SELECT * FROM covoiturage WHERE Id_covoiturage = :cov_id JOIN utilisateur ON utilisateur.Id_utilisateur = covoiturage.Id_utilisateur";
$stmt = $pdo->prepare($sql);
$stmt->execute([':cov_id' => $cov_id]);
$reserve = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($reserve);
if (!$reserve) {
    die("Trajet non trouvé.");
}

// Vérifier la soumission du formulaire de réservation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $places_reserves = $_POST['places_reserves'];

    // Vérifier que le nombre de sièges est disponible
    if ($places_reserves > $reserve['nb_place']) {
        die("Nombre de sièges insuffisant.");
    }

    // Réserver les sièges
    $Id_utilisateur = $_SESSION['Id_utilisateur'];
    $sql = "INSERT INTO reservations (Id_covoiturage, Id_utilisateur, places_reserves) VALUES (:Id_covoiturage, :Id_utilisateur, :places_reserves)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':Id_covoiturage' => $Id_covoiturage,
        ':Id_utilisateur' => $Id_utilisateur,
        ':places_reserves' => $places_reserves
    ]);

    // Mettre à jour le nombre de sièges disponibles
    $sql = "UPDATE covoiturage SET Nb_place = Nb_place - :place_reserves WHERE id = :Id_covoiturage";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':places_reserves' => $places_reserves,
        ':Id_covoiturage' => $Id_covoiturage
    ]);

    echo "Réservation réussie!";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation de Trajet</title>
</head>

<body>
    <h1>Réserver un trajet</h1>
    <p>Trajet: <?= htmlspecialchars($reserve['lieu_depart']) ?> → <?= htmlspecialchars($reserve['lieu_arrivee']) ?> le <?= htmlspecialchars($reserve['date_depart']) ?></p>
    <form method="post">
        <label for="places_reserves">Nombre de sièges à réserver:</label>
        <input type="number" name="places_reserves" min="1" max="<?= $reserve['nb_place'] ?>" required>
        <button type="submit">Réserver</button>
    </form>
</body>

</html>

<?= require_once('../includes/footer.php'); ?>