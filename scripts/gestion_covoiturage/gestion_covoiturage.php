<?php

// S'assurer d'envoyer du JSON
header('Content-Type: application/json');

require_once '../../includes/connect.php';

if (isset($_POST['startOrStop'])) {
  // On récupère "D" ou "T"
  $startOrStop = $_POST['startOrStop'];
  // On met à la jour la colonne statut de la table covoiturage de la DB
  // On met à jour le statut de la table covoiturage de la DB
  $query = "UPDATE covoiturage SET statut = :statut WHERE id = :id";
  $stmt = $conn->prepare($query);
  if ($startOrStop == 'D') {
    $sql = "UPDATE covoiturage
SET statut = REPLACE(statut, 'disponible', 'en cours')";
  } else {
    $sql = "UPDATE covoiturage  
SET statut = REPLACE(statut, 'en cours', 'terminé')";
  }
  // TODO Le faire
  // Test du retour : à commenter quand le TODO sera terminé
  echo json_encode($startOrStop);
}
