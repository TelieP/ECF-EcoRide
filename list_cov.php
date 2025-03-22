<?php
require_once 'includes/connect.php';
// Inclure le fichier d'en-tête
include_once('includes/header.php');
echo " LISTE DES COVOITURAGES DISPONIBLES ";
include('list_cov.php');

foreach ($trajets as $trajet) {
    echo "<li>";
    echo "Trajet de " . $trajet['lieu_depart'] . " à " . $trajet['lieu_arrivee'] . "<br>";
    echo "Date : " . $trajet['date_depart'] . "<br>";
    //echo "Conducteur : " . $trajet['conducteur'] . "<br>";
    echo "Places disponibles : " . $trajet['nb_place'] . "<br>";
    echo "Prix : " . $trajet['prix_personne'] . " €<br>";
    echo "</li>";
}
?>

<?php
// Inclure le fichier de pied de page
include_once('includes/footer.php');
?>