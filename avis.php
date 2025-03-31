<?php
require_once 'includes/connect.php';
require_once 'includes/header.php';
echo " Bienvenue sur la page d'avis";
session_start();
$profil =  $_SESSION['Id_utilisateur'];
// Récupérer les avis de l'utilisateur
$sql = "SELECT a.commentaire, a.note, c.date_depart, c.heure_depart, c.lieu_depart, c.lieu_arrivee
        FROM avis AS a
        JOIN covoiturage AS c ON a.Id_covoiturage = c.Id_covoiturage
        WHERE a.Id_utilisateur = :Id_utilisateur";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':Id_utilisateur', $profil);
$stmt->execute();
$avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($avis);

?>


<?= require_once 'includes/footer.php'; ?>
