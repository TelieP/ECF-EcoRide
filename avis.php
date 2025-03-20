<?php
require_once 'includes/connect.php';
require_once 'includes/header.php';
echo " Bienvenue sur la page d'avis";
session_start();
$profil =  $_SESSION['Id_utilisateur'];
// Récupérer les avis de l'utilisateur
$stmt = $conn->prepare("SELECT * FROM avis WHERE Id_utilisateur = ?");
$stmt->bindparam("i", $profil);
$stmt->execute();
$avis = $stmt->getresult();




?>


<?= require_once 'includes/footer.php'; ?>
