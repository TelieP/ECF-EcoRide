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



    <?= require_once('includes/footer.php'); ?>