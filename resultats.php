<?php
require_once('includes/connect.php');
require_once('includes/header.php');



// Si des paramètres sont envoyés via POST
// if (isset($_POST['depart'], $_POST['arrivee'], $_POST['date'])) {
if (isset($_GET['depart']) && isset($_GET['arrivee']) && isset($_GET['date'])) {
    $depart = $_GET['depart'];
    $arrivee = $_GET['arrivee'];
    $date = $_GET['date'];

    // Requête SQL pour rechercher les trajets
    // $sql = "SELECT * FROM covoiturage WHERE lieu_depart LIKE :depart AND lieu_arrivee LIKE :arrivee AND  DATE(date_depart) LIKE :date AND nb_place > 0";
    $sql = "SELECT * FROM `covoiturage` WHERE lieu_depart LIKE :depart AND lieu_arrivee LIKE :arrivee AND  DATE(date_depart) LIKE :date AND nb_place > 0";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':depart', "%" . $depart . "%");
    $stmt->bindValue(':arrivee', "%" . $arrivee . "%");
    $stmt->bindValue(':date', $date);

    $stmt->execute();
    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($trajets);

    if (count($trajets) > 0) {
        echo "Trajets disponibles <br>";
        echo "<ul>";
        foreach ($trajets as $trajet) {
            echo "<li>";
            echo "Trajet de " . $trajet['lieu_depart'] . " à " . $trajet['lieu_arrivee'] . "<br>";
            echo "Date : " . $trajet['date_depart'] . "<br>";
            //echo "Conducteur : " . $trajet['conducteur'] . "<br>";
            echo "Places disponibles : " . $trajet['nb_place'] . "<br>";
            echo "Prix : " . $trajet['prix_personne'] . " €<br>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucun trajet trouvé pour cette recherche.</p>";
    }
}
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center"><i class="fas fa-car"></i> Trajets disponibles</h2>

        <?php if (count($trajets) > 0): ?>
            <div class="list-group mt-4">
                <?php foreach ($trajets as $trajet): ?>
                    <div class="list-group-item list-group-item-action">
                        <h5><i class="fas fa-map-marker-alt"></i> De <?= htmlspecialchars($trajet['lieu_depart']) ?> à <?= htmlspecialchars($trajet['lieu_arrivee']) ?></h5>
                        <p><i class="far fa-calendar-alt"></i> Date : <?= $trajet['date_depart'] ?> à <?= $trajet['heure_depart'] ?></p>
                        <p><i class="fas fa-user"></i> Conducteur : <?= htmlspecialchars($trajet['conducteur']) ?></p>
                        <p><i class="fas fa-car-side"></i> Véhicule : <?= htmlspecialchars($trajet['vehicule']) ?></p>
                        <p><i class="fas fa-euro-sign"></i> Prix : <?= number_format($trajet['prix'], 2) ?> €</p>
                        <a href="reserver.php?id=<?= $trajet['Id_covoiturage'] ?>" class="btn btn-success"><i class="fas fa-check"></i> Réserver</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-4"><i class="fas fa-exclamation-circle"></i> Aucun trajet trouvé</div>
        <?php endif; ?>
    </div>
</body>

</html>
<?php
require_once('includes/footer.php');
?>