<?php
session_start();
require_once 'includes/connect.php';
require_once 'includes/header.php';
//on recupere les infos du formulaire et on les stock en base de données
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $energie = $_POST['energie'];
    $couleur = $_POST['couleur'];
    $immatriculation = $_POST['immatriculation'];
    $date_premiere_immatriculation = $_POST['date_premiere_immatriculation'];
    $stmt = $conn->prepare("INSERT INTO `voiture` ( `modele`,`immatriculation`, `energie`, `couleur`, `date_premiere_immatriculation`) VALUES (:modele,:mmatriculation, :energie, :couleur, :date_premiere_immatriculation)");
    $stmt->bindParam(':marque', $marque, PDO::PARAM_STR);
    $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
    $stmt->bindParam(':energie', $energie, PDO::PARAM_STR);
    $stmt->bindParam(':couleur', $couleur, PDO::PARAM_STR);
    $stmt->bindParam(':date_premiere_immatriculation', $immatriculation, PDO::PARAM_STR);
    if ($stmt->execute()) {
        echo "Voiture ajoutée avec succès";
    } else {
        echo "Erreur lors de l'ajout de la voiture";
    }
}

?>
<h1>Ajouter une voiture</h1>
<form class="form-group" method="post">
    Marque: <input type="text" name="marque" required>
    Modèle: <input type="text" name="modele" required>
    Energie: <input type="text" name="energie" required>
    Couleur: <input type="text" name="couleur" required>
    Immatriculation: <input type="text" name="immatriculation" required>
    Date de première immatriculation: <input type="date" name="date_premiere_immatriculation" required><br><br>
    <button type="submit">Ajouter</button>