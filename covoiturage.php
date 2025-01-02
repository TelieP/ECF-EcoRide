<?php
session_start();
require_once 'db.php'; // Connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $utilisateur_id = $_SESSION['user_id'];
    $ville_depart = $_POST['lieu_depart'];
    $ville_arrivee = $_POST['lieu_arrivee'];
    $date_depart = $_POST['date_depart'];
    $places_disponibles = $_POST['nb_place'];
    $prix = $_POST['prix_personne'];
    $heure_depart= $_POST['heure_depart'];
    $heure_arrivee= $_POST['heure_arrive'];
    $statut= $_POST['statut'];

    $stmt = $conn->prepare("INSERT INTO `covoiturage` (utilisateur_id, lieu_depart, lieu_arrivee, date_depart, nb_place, prix,heure_depart,heure_arrivee,statut) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssii", $utilisateur_id, $ville_depart, $ville_arrivee, $date_depart, $places_disponibles, $prix,$heure_depart,$heure_arrivee,$statut);

    if ($stmt->execute()) {
        echo "Trajet ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du trajet.";
    }
}
?>

<form method="post">
    Ville de départ: <input type="text" name="lieu_depart" required><br>
    Ville d'arrivée: <input type="text" name="lieu_arrivee" required><br>
    Date de départ: <input type="datetime-local" name="date_depart" required><br>
    Nombre de places disponibles: <input type="number" name="nb_place" required><br>
    Prix: <input type="number" step="0.01" name="prix_personne" required><br>
    Heure de départ: <input type="text" name="heure_depart" required><br>
    Heure d'arrivée: <input type="text" name="heure_arrivee" required><br>
    Statut: <input type="text" name="statut" required><br>
    <button type="submit">Ajouter le trajet</button>
</form>
