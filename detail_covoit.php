<?php
require_once('includes/connect.php');
require_once('includes/header.php');
echo " page de détail du covoiturage";

$sql = "SELECT c.Id_covoiturage, c.heure_depart, c.date_depart, c.nb_place ,c.heure_arrivee, utilisateur.nom, utilisateur.prenom, voiture.modele, voiture.immatriculation, covoiturage.prix_personne, covoiturage.lieu_depart, covoiturage.lieu_arrivee
FROM covoiturage JOIN voiture ON v.Id_voiture = c.Id_voiture
JOIN utilisateur  ON utilisateur.Id_utilisateur = voiture.Id_voiture
WHERE  Id_covoiturage = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $_POST['id']);
$stmt->execute();
$trajets = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php foreach ($trajets as $trajet): ?>
    <div class="list-group-item list-group-item-action">
        <h5><i class="bi bi-geo-fill"></i> De <?= htmlspecialchars($trajet['lieu_depart']) ?></br><i class="bi bi-arrow-down"></i></br> <i class="bi bi-geo-fill"></i> à <?= htmlspecialchars($trajet['lieu_arrivee']) ?></h5>
        <p><i class="bi bi-calendar3"></i> Date : <?= $trajet['date_depart'] ?> à <?= $trajet['heure_depart'] ?></p>
        <p><i class="bi bi-person-workspace"></i> Conducteur : <?= htmlspecialchars($trajet['nom']) ?> <?= htmlspecialchars($trajet['prenom']) ?></p>
        <p><i class="bi bi-car-front-fill"></i> Véhicule : <?= htmlspecialchars($trajet['modele']) ?> <?= htmlspecialchars($trajet['immatriculation']) ?></p>
        <p><i class="bi bi-cash-coin"></i> Prix : <?= number_format($trajet['prix_personne'], 2) ?> €</p>
        <a href="reserver.php?id=<?= $trajet['Id_covoiturage'] ?>" class="btn btn-success"><i class="fas fa-check"></i> Réserver</a>

    </div>
<?php endforeach; ?>
<?php require_once('includes/footer.php'); ?>