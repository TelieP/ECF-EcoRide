<?php
require_once 'includes/connect.php';
require_once 'includes/header.php';
echo " Bienvenue sur la page d'avis";
session_start();
var_dump($_SESSION);
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
} else {
        // Connexion !
}
// var_dump($avis);
// Afficher les avis


?>


<?= require_once 'includes/footer.php'; ?>
