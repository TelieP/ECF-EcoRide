<?php
require_once 'includes/connect.php';
require_once 'includes/header.php';
echo " Donner votre avis sur le trajet réservé  <br>";
session_start();
$profil = '';
if ($_SESSION && $_SESSION["user"]['Id_utilisateur']) {
        $profil = $_SESSION["user"]['Id_utilisateur'];
}
if ($profil) {
        // Récupérer les avis de l'utilisateur

        $sql = "SELECT c.date_depart, c.heure_depart, c.lieu_depart, c.lieu_arrivee, r.places_reserves
                        FROM reservation AS r
                        JOIN covoiturage AS c ON r.Id_covoiturage = c.Id_covoiturage
                        WHERE r.Id_utilisateur = :Id_utilisateur";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':Id_utilisateur', $profil);
        $stmt->execute();
        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($avis);
        // formulaire de saisie d'avis
        echo '<form method="post" class="form-group"><br>';
        echo '<div class="mb-3 text-center" id="form-controler">';
        echo '<div class="mb-3">';
        echo '<label for="avis" style: color="white">Votre avis</label><br>';
        echo '<textarea id="story" name="story" rows="5" cols="33" placeholder="saisissz votre avs ici" ></textarea>';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="note">Votre note</label><br>';
        echo '<input type="number" name="note" id="note" required placeholder="Votre note" min="1" max="5">';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary mb-3">Envoyer</button><br>';
        echo '</div>';
        echo '</form>';
} else {
        // Connexion !
}
// Afficher les avis



?>


<?= require_once 'includes/footer.php'; ?>
