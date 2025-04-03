<?php
session_start(); // Démarrer la session
require_once 'includes/connect.php';
require_once 'includes/header.php';
// var_dump($_SESSION);
// Vérifier si l'utilisateur est connecté   
if (isset($_SESSION['user'])) {
    // die("Veuillez vous connecter pour ajouter un covoiturage." . " <a href='connexion.php'>Se connecter</a>");

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Vérifier si l'utilisateur a le rôle de conducteur
        if ($_SESSION['role'] != 'conducteur') {
            die("Vous devez être conducteur pour ajouter un covoiturage.");
        }

        // Vérifier si le formulaire a été soumis

        $depart = $_POST['lieu_depart'];
        $arrivee = $_POST['lieu_arrivee'];
        $date = $_POST['date_depart'];
        $heure = $_POST['heure_depart'];
        $nb_place = $_POST['nb_place'];
        $statut = $_POST['statut'];
        $prix = $_POST['prix'];
        //on recupere les infos du formulaire et on les stock en base de données
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $stmt = $conn->prepare("INSERT INTO `covoiturage` (`date_depart`, `heure_depart`, `lieu_depart`, `lieu_arrivee`, `statut`, `nb_place`, `prix_personne`) VALUES (:date_depart, :heure_depart, :lieu_depart, :lieu_arrivee, :statut, :nb_place, :prix)");
            $stmt->bindParam(':lieu_depart', $depart, PDO::PARAM_STR);
            $stmt->bindParam(':lieu_arrivee', $arrivee, PDO::PARAM_STR);
            $stmt->bindParam(':date_depart', $date, PDO::PARAM_STR);
            $stmt->bindParam(':heure_depart', $heure, PDO::PARAM_STR);
            $stmt->bindParam(':nb_place', $nb_place, PDO::PARAM_INT);
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "Covoiturage ajouté avec succès";
            } else {
                echo "Erreur lors de l'ajout du covoiturage";
            }
        }
    }
} else {
    die("Veuillez vous connecter pour ajouter un covoiturage." . " <a href='connexion.php'>Se connecter</a>");
}
?>
<h1>Ajouter un covoiturage</h1></br>
<form class="form-group" method="post">
    Ville de départ: <input type="text" name="lieu_depart" required>
    Ville d'arrivée: <input type="text" name="lieu_arrivee" required>
    Date départ: <input type="date" name="date_depart" required>
    Heure départ: <input type="time" name="heure_depart" required>
    Nombre de places: <input type="number" name="nb_place" required>
    <label for="voiture">Voiture</label>

    statut: <input type="text" name="statut" required>
    Prix: <input type="number" name="prix" required><br>
    <button type="submit">Ajouter</button>
</form>

<?php
require_once 'includes/footer.php'; // Inclusion du footer
?>