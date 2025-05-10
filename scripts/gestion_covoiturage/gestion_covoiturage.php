<?php

// S'assurer d'envoyer du JSON
header('Content-Type: application/json');

require_once '../../includes/connect.php';

if (isset($_POST['startOrStop'])) {
  // On récupère "D" ou "T"
  $startOrStop = $_POST['startOrStop'];
  // On met à la jour la colonne statut de la table covoiturage de la DB ('dispobible' ou 'en cours')
  $query = "UPDATE covoiturage SET statut = :statut WHERE id = :id";
  $stmt = $conn->prepare($query);
  if ($startOrStop == 'D') {
    // Le vocovoit a démarré
    $sql = "UPDATE covoiturage
      SET statut = REPLACE(statut, 'disponible', 'en cours')";
  } else {
    // Le covoit est terminé
    $sql = "UPDATE covoiturage  
      SET statut = REPLACE(statut, 'en cours', 'terminé')";
  }
  // On revoie au JS "D" ou "T"
  echo json_encode($startOrStop);
}
