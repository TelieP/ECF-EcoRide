<?php
session_start();
require_once 'includes/connect.php'; // Connexion à la base de données
var_dump($_SESSION);
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trajet_id = $_POST['trajet_id'];
    $nombre_places = $_POST['nombre_places'];
    $utilisateur_id = $_SESSION['user_id'];

    // Vérifier qu'il y a assez de places disponibles
    $stmt = $conn->prepare("SELECT places_disponibles FROM trajets WHERE id = ?");
    $stmt->bindparam("i", $trajet_id);
    $stmt->execute();
    $result = $stmt->getresult();
    $trajet = $result->fetch_assoc();

    if ($trajet['places_disponibles'] >= $nombre_places) {
        // Réserver le trajet
        $stmt = $conn->prepare("INSERT INTO reservations (trajet_id, utilisateur_id, nombre_places) VALUES (?, ?, ?)");
        $stmt->bindparam("iii", $trajet_id, $utilisateur_id, $nombre_places);

        if ($stmt->execute()) {
            // Mettre à jour le nombre de places disponibles
            $places_disponibles = $trajet['places_disponibles'] - $nombre_places;
            $stmt = $conn->prepare("UPDATE trajets SET places_disponibles = ? WHERE id = ?");
            $stmt->bindparam("ii", $places_disponibles, $trajet_id);
            $stmt->execute();

            echo "Réservation réussie!";
        } else {
            echo "Erreur lors de la réservation.";
        }
    } else {
        echo "Il n'y a pas assez de places disponibles.";
    }
}

// Récupérer les trajets existants
$stmt = $conn->prepare("SELECT * FROM trajets");
$stmt->execute();
$result = $stmt->getresult();
?>

<form method="post">
    Trajet:
    <select name="trajet_id" required>
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['ville_depart'] ?> → <?= $row['ville_arrivee'] ?> | <?= $row['date_depart'] ?></option>
        <?php endwhile; ?>
    </select><br>
    Nombre de places: <input type="number" name="nombre_places" required><br>
    <button type="submit">Réserver</button>
</form>