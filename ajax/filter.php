<?php

// S'assurer d'envoyer du JSON
header('Content-Type: application/json');

require_once('../includes/connect.php');

// On récupère la variable ecological (0 ou 1) passée dans la requête Ajax du fichier filter.js
if (isset($_GET['ecological'])) {
  // Checked or not
  $ecological = $_GET['ecological'] == 1 ? "=" : "!=";
  // Query
  // Le reste : comme d'habitude
  $sql = "SELECT c.Id_covoiturage, c.heure_depart, c.date_depart, c.nb_place, u.photo,
            c.heure_arrivee, u.nom, u.prenom, v.modele, v.immatriculation, c.prix_personne, c.lieu_depart, c.lieu_arrivee
                FROM covoiturage AS c
                JOIN voiture AS v ON v.Id_voiture = c.Id_voiture
                JOIN utilisateur AS u ON u.Id_utilisateur = v.Id_voiture
                WHERE v.energie  $ecological 'Electrique'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // On renvoie les trajets sous forme JSON : PHP veut un "echo" et non un return (ne me demande pas pourquoi ^^)
  echo json_encode($trajets);
  exit;
}


// On récupère la variable lowprice (0 ou 1) passée dans la requête Ajax du fichier filter.js
if (isset($_GET['lowprice'])) {
  // Cocher ou pas
  $lowprice = $_GET['lowprice'] == 1 ? "DESC" : "ASC";

  $sql = "SELECT c.Id_covoiturage, c.heure_depart, c.date_depart, c.nb_place, u.photo,
            c.heure_arrivee, u.nom, u.prenom, v.modele, v.immatriculation, c.prix_personne, c.lieu_depart, c.lieu_arrivee
                FROM covoiturage AS c
                JOIN voiture AS v ON v.Id_voiture = c.Id_voiture
                JOIN utilisateur AS u ON u.Id_utilisateur = v.Id_voiture
                ORDER BY c.prix_personne  $lowprice";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // On renvoie les trajets sous forme JSON : PHP veut un "echo" et non un return (ne me demande pas pourquoi ^^)
  echo json_encode($trajets);
  exit;
}
