<?php
session_start(); // Démarrer la session
require_once 'includes/connect.php';
require_once 'includes/header.php';
// var_dump($_SESSION);
// Vérifier si l'utilisateur est connecté   
if (isset($_SESSION['user'])) {
    // die("Veuillez vous connecter pour ajouter un covoiturage." . " <a href='connexion.php'>Se connecter</a>");
    var_dump($_SESSION['user']);
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Vérifier si l'utilisateur a le rôle de conducteur
        // if ($_SESSION['role'] != 'conducteur') {
        //     die("Vous devez être conducteur pour ajouter un covoiturage.");
        // }

        // Vérifier si le formulaire a été soumis

        $depart = htmlspecialchars($_POST['lieu_depart']);
        $arrivee = htmlspecialchars($_POST['lieu_arrivee']);
        $date = htmlspecialchars($_POST['date_depart']);
        $heure = htmlspecialchars($_POST['heure_depart']);
        $nb_place = htmlspecialchars($_POST['nb_place']);
        $statut = htmlspecialchars($_POST['statut']);
        $prix = htmlspecialchars($_POST['prix']);
        //on recupere les infos du formulaire et on les stock en base de données
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sql = "SELECT Id_voiture
            FROM voiture AS v
            JOIN utilisateur AS u ON u.Id_utilisateur = v.Id_utilisateur
            WHERE u.Id_utilisateur = $_SESSION(['user']['Id_utilisateur'])";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':Id_utilisateur', $_SESSION(['user']['Id_utilisateur']), PDO::PARAM_INT);
            $stmt->execute();
            $voiture = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $conn->prepare("INSERT INTO `covoiturage` (`date_depart`, `heure_depart`, `lieu_depart`, `lieu_arrivee`, `statut`, `nb_place`, `prix_personne`,Id_voiture) VALUES (:date_depart, :heure_depart, :lieu_depart, :lieu_arrivee, :statut, :nb_place, :prix, :Id_voiture)");
            $stmt->bindParam(':lieu_depart', $depart, PDO::PARAM_STR);
            $stmt->bindParam(':lieu_arrivee', $arrivee, PDO::PARAM_STR);
            $stmt->bindParam(':date_depart', $date, PDO::PARAM_STR);
            $stmt->bindParam(':heure_depart', $heure, PDO::PARAM_STR);
            $stmt->bindParam(':nb_place', $nb_place, PDO::PARAM_INT);
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
            $stmt->bindParam(':Id_voiture', $_POST['voiture'], PDO::PARAM_INT);
            $stmt->bindParam(':Id_utilisateur', $_SESSION['user']['Id_utilisateur'], PDO::PARAM_INT);
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
    <div>
        <label for="Ville de départ"> Ville de départ</label>
        <input type="text" name="lieu_depart" required>
    </div>
    <div>
        <label for="Ville d'arrivée">Ville d'arrivée</label>
        <input type="text" name="lieu_arrivee" required>
    </div>
    <div>
        <label for="Date départ">Date départ</label>
        <input type="date" name="date_depart" required>
    </div>
    <div>
        <label for="Heure départ">Heure départ</label>
        <input type="time" name="heure_depart" required>
    </div>
    <div>
        <label for=" Nombre de places"> Nombre de places</label>
        <input type="number" name="nb_place" required>
    </div>
    <div>
        <label for="voiture">Voiture</label>
        <!-- faire une liste deroulante pour afficher les marques de voiture -->
        <select class="mb-2" name="voiture" id="voiture">
            <?php
            $UserId = $_SESSION['user']['Id_utilisateur'];
            $stmt = $conn->query("SELECT * FROM marque");
            foreach ($stmt as $row) {
                echo "<option value='" . $row['Id_marque'] . "'>" . $row['libelle'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label for="statut">statut</label>
        <input type="text" name="statut" required>
    </div>
    <div>
        <label for="prix">Prix</label>
        <input type="number" name="prix" required><br>
    </div>
    <button type="submit">Ajouter</button>
</form>

<?php
require_once 'includes/footer.php'; // Inclusion du footer
?>