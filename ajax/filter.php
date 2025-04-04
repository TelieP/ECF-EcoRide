<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header('Content-Type: application/json');

require_once('../includes/connect.php');

if (isset($_GET['ecological'])) {
  // Checked or not
  $ecological = $_GET['ecological'] == 1 ? "=" : "!=";
  // Query
  $sql = "SELECT c.Id_covoiturage, c.heure_depart, c.date_depart, c.nb_place, u.photo,
            c.heure_arrivee, u.nom, u.prenom, v.modele, v.immatriculation, c.prix_personne, c.lieu_depart, c.lieu_arrivee
                FROM covoiturage AS c
                JOIN voiture AS v ON v.Id_voiture = c.Id_voiture
                JOIN utilisateur AS u ON u.Id_utilisateur = v.Id_voiture
                WHERE v.energie  $ecological 'Electrique'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($trajets);
  exit;
}
