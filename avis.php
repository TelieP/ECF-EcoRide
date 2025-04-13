<?php
require_once 'includes/connect.php';
require_once 'includes/header.php';
echo " Donner votre avis sur le trajet réservé  <br>";
session_start();
$profil = '';
if ($_SESSION && $_SESSION["user"]['Id_utilisateur']) {
        $profil = $_SESSION["user"]['Id_utilisateur'];
}
if ($profil) {
        // Récupérer les avis de l'utilisateur

        $sql = "SELECT c.date_depart, c.heure_depart, c.lieu_depart, c.lieu_arrivee, r.places_reserves
                        FROM reservation AS r
                        JOIN covoiturage AS c ON r.Id_covoiturage = c.Id_covoiturage
                        WHERE r.Id_utilisateur = :Id_utilisateur";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':Id_utilisateur', $profil);
        $stmt->execute();
        $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

        <form method="post" class="form-group"><br>
                <div class="mb-3 text-center" id="form-controler">
                        <div class="mb-3">
                                <label for="avis" style: color="white">Votre avis</label><br>
                                <textarea id="story" name="story" rows="5" cols="33" placeholder="saisissz votre avs ici"></textarea>
                        </div>
                        <div class="mb-3">
                                <label for="note">Votre note</label><br>
                                <input type="number" name="note" id="note" required placeholder="Votre note" min="1" max="5">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Envoyer</button><br>
                </div>
        </form>
<?php
        // envoi de l'avis dans la base de données
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $avis = $_POST['story'];
                $note = $_POST['note'];
                $sql = "INSERT INTO avis (commentaire, note)
                 VALUES (:avis, :note)";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':note', $note);
                $stmt->bindValue(':avis', $avis);
                if ($stmt->execute()) {
                        echo "Votre avis a été enregistré avec succès !";
                } else {
                        echo "Erreur lors de l'enregistrement de votre avis.";
                }
        }
} else {
        // Connexion !
}
// Afficher les avis



?>


<?= require_once 'includes/footer.php'; ?>