<?php
require_once('includes/header.php');
require_once('includes/connect.php');
?>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    die("Veuillez vous connecter pour ajouter une voiture." . " <a href='connexion.php'>Se connecter</a>");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $date_mise_en_circulation = $_POST['date_mise_en_circulation'];
    $immatriculation = $_POST['immatriculation'];
    $energie = $_POST['energie'];
    $preferences = $_POST['preferences'];

    // Préparer la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO voiture (Id_utilisateur, marque, modele, date_mise_en_circulation, immatriculation, nb_place) VALUES (:Id_utilisateur, :marque, :modele, :date_mise_en_circulation, :immatriculation, :nb_place)");
    $stmt->bindParam(':Id_utilisateur', $_SESSION['user']['Id_utilisateur']);
    $stmt->bindParam(':marque', $marque);
    $stmt->bindParam(':modele', $modele);
    $stmt->bindParam(':date_mise_en_circulation', $date_mise_en_circulation);
    $stmt->bindParam(':immatriculation', $immatriculation);
    $stmt->bindParam(':nb_place', $nb_place);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Voiture ajoutée avec succès !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout de la voiture.</div>";
    }
}
// Formulaire d'ajout de voiture
?>
<div class="container mt-4">
    <h1>Ajouter une voiture</h1>
    <form action="" method="post">
        <div class="col-auto">
            <label for="marque">Marque</label>
            <input type="text" name="marque" id="marque" placeholder="Marque de votre voiture" required>
        </div>
        <div class="col-auto">
            <label for="modele">Modèle</label>
            <input type="text" name="modele" id="modele" placeholder="Modèle" required>
        </div>
        <div class="col-auto">
            <label for="date_mise_en_circulation">Date de mise en circulation</label>
            <input type="date" name="date_mise_en_circulation" id="date_mise_en_circulation" placeholder="JJ/MM/AAAA" required>
        </div>
        <div class="col-auto">
            <label for="immatriculation">Immatriculation</label>
            <input type="text" name="immatriculation" id="immatriculation" placeholder="Immatriculation" required>
        </div>
        <div class="col-auto">
            <label for="energie">Énergie</label>
            <select name="energie" id="energie" required>
                <option value="essence">Essence</option>
                <option value="diesel">Diesel</option>
                <option value="electrique">Électrique</option>
                <option value="hybride">Hybride</option>
            </select>
        </div>

        <div class="col-auto">
            <label for="preferences">Préférences</label></br>
            <select name="preferences" id="preferences" required>
                <option value="fumeur">Fumeur</option>
                <option value="non_fumeur">Non fumeur</option>
                <option value="animaux">Animaux</option>
                <option value="pas_animaux">Pas d'animaux</option>
                <option value="musique">Musique</option>
                <option value="pas_musique">Pas de musique</option>
                <option value="autre">Autre</option>
            </select></br></br>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>

</div>






</form>
</div>
<?php
require_once('includes/footer.php');


?>