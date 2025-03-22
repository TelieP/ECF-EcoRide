<?php
// Démarrer la session pour récupérer les données de l'utilisateur (si nécessaire)
session_start();

// Inclure la configuration pour la connexion à la base de données
require_once('includes/connect.php');
require_once('includes/header.php');
?>

<body>

    <h1>Rechercher un Covoiturage</h1>

    <!-- <form action="" method="POST" class="form-group">

        <label for="depart">Ville de départ </label>
        <input type="text" id="depart" name="depart" required><br><br>

        <label for="arrivee">Ville d'arrivée </label>
        <input type="text" id="arrivee" name="arrivee" required><br><br>

        <label for="date">Date du trajet </label>
        <input type="date" id="date" name="date" required><br><br>

        <button type="submit">Rechercher</button>
    </form> -->
    <form action="" method="POST" class="form-group  text-white p-5 w-50 mx-auto">
        <div class="row g-3">
            <div class="col">
                <label for="depart">Ville de départ </label>
                <input type="text" class="form-control" id="depart" name="depart" required placeholder="ville de depart">
            </div>
            <div class="col">
                <label for="arrivee">Ville d'arrivée </label>
                <input type="text" class="form-control" id="arrivee" name="arrivee" required placeholder="ville d'arrivée">
            </div>
            <div class="col">
                <label for="date">Date du trajet </label>
                <input type="date" class="form-control" id="date" name="date" required placeholder="date">
            </div>
            <button type="submit">Rechercher</button>
        </div>
    </form>


    <?php

    // Si des paramètres sont envoyés via POST
    // if (isset($_POST['depart'], $_POST['arrivee'], $_POST['date'])) {
    if (isset($_POST['depart']) && isset($_POST['arrivee']) && isset($_POST['date'])) {
        $depart = $_POST['depart'];
        $arrivee = $_POST['arrivee'];
        $date = $_POST['date'];

        // Requête SQL pour rechercher les trajets
        // $sql = "SELECT * FROM covoiturage WHERE lieu_depart LIKE :depart AND lieu_arrivee LIKE :arrivee AND  DATE(date_depart) LIKE :date AND nb_place > 0";
        $sql = "SELECT covoiturage.Id_covoiturage, covoiturage.heure_depart, covoiturage.date_depart, covoiturage.nb_place ,covoiturage.heure_arrivee, utilisateur.nom, utilisateur.prenom, voiture.modele, voiture.immatriculation, covoiturage.prix_personne, covoiturage.lieu_depart, covoiturage.lieu_arrivee
        FROM covoiturage
        JOIN voiture ON voiture.Id_voiture = covoiturage.Id_voiture
        JOIN utilisateur  ON utilisateur.Id_utilisateur = voiture.Id_voiture
        WHERE  lieu_depart = :depart AND lieu_arrivee = :arrivee AND  DATE(date_depart) = :date AND nb_place > 0";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':depart',  $depart);
        $stmt->bindValue(':arrivee',  $arrivee);
        $stmt->bindValue(':date', $date);

        $stmt->execute();
        $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($trajets);

        if (count($trajets) > 0): ?>
            <div class="list-group mt-4">
                <?php foreach ($trajets as $trajet): ?>
                    <div class="list-group-item list-group-item-action">
                        <h5><i class="fas fa-map-marker-alt"></i> De <?= htmlspecialchars($trajet['lieu_depart']) ?> à <?= htmlspecialchars($trajet['lieu_arrivee']) ?></h5>
                        <p><i class="far fa-calendar-alt"></i> Date : <?= $trajet['date_depart'] ?> à <?= $trajet['heure_depart'] ?></p>
                        <p><i class="fas fa-user"></i> Conducteur : <?= htmlspecialchars($trajet['nom']) ?> <?= htmlspecialchars($trajet['prenom']) ?></p>
                        <p><i class="fas fa-car-side"></i> Véhicule : <?= htmlspecialchars($trajet['modele']) ?> <?= htmlspecialchars($trajet['immatriculation']) ?></p>
                        <p><i class="fas fa-euro-sign"></i> Prix : <?= number_format($trajet['prix_personne'], 2) ?> €</p>
                        <a href="reserver.php?id=<?= $trajet['Id_covoiturage'] ?>" class="btn btn-success"><i class="fas fa-check"></i> Réserver</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-4"><i class="fas fa-exclamation-circle"></i> Aucun trajet trouvé</div>
        <?php endif; ?>
        </div>
    <?php
    }
    ?>
</body>

<?= require_once('includes/footer.php'); ?>