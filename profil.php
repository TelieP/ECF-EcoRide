<?php
session_start();
// Vérification de la session utilisateur (l'utilisateur doit être connecté)
if (!isset($_SESSION['user'])) {
    die("Veuillez vous connecter pour accéder à votre profil." . " <a href='connexion.php'>Se connecter</a>");
}
// Connexion à la base de données

include('includes/connect.php');
include('includes/header.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

</head>


<body>
    <h1>Mon Profil</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($_SESSION['user']['photo']) ?>" alt="Photo de profil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
            </div>
            <div class="col-md-8">
                <h2><?= htmlspecialchars($_SESSION['user']['nom']) ?> <?= htmlspecialchars($_SESSION['user']['prenom']) ?></h2>
                <p>Email : <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                <p>Téléphone : <?= htmlspecialchars($_SESSION['user']['telephone']) ?></p>
                <p>Adresse : <?= htmlspecialchars($_SESSION['user']['adresse']) ?></p>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h2>Mes Trajets Réservés</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Lieu de départ</th>
                    <th>Lieu d'arrivée</th>
                    <th>Nombre de places réservées </th>

                    <th> avis</th>

                </tr>
            </thead>
            <tbody>
                <?php
                // Requête pour récupérer les trajets réservés par l'utilisateur
                $Id_utilisateur = $_SESSION['user']['Id_utilisateur'];
                $sql = "SELECT c.date_depart, c.heure_depart, c.lieu_depart, c.lieu_arrivee, r.places_reserves
                        FROM reservation AS r
                        JOIN covoiturage AS c ON r.Id_covoiturage = c.Id_covoiturage
                        WHERE r.Id_utilisateur = :Id_utilisateur";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':Id_utilisateur', $Id_utilisateur);
                $stmt->execute();
                $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($reservations as $reservation) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($reservation['date_depart']) . "</td>";
                    echo "<td>" . htmlspecialchars($reservation['heure_depart']) . "</td>";
                    echo "<td>" . htmlspecialchars($reservation['lieu_depart']) . "</td>";
                    echo "<td>" . htmlspecialchars($reservation['lieu_arrivee']) . "</td>";
                    echo "<td>" . htmlspecialchars($reservation['places_reserves']) . "</td>";

                    echo "<td><a href='avis.php' class='btn btn-primary'>Donner un avis</a></td>";


                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <h2>Mes Trajets Proposés</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Lieu de départ</th>
                    <th>Lieu d'arrivée</th>
                    <th>Nombre de places disponibles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Requête pour récupérer les trajets proposés par l'utilisateur
                $sql = "SELECT c.date_depart, c.heure_depart, c.lieu_depart, c.lieu_arrivee, c.nb_place
                        FROM covoiturage AS c
                        JOIN voiture AS v ON c.Id_voiture = v.Id_voiture
                        WHERE v.Id_utilisateur = :Id_utilisateur";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':Id_utilisateur', $Id_utilisateur);
                $stmt->execute();
                $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);


                foreach ($trajets as $trajet) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($trajet['date_depart']) . "</td>";
                    echo "<td>" . htmlspecialchars($trajet['heure_depart']) . "</td>";
                    echo "<td>" . htmlspecialchars($trajet['lieu_depart']) . "</td>";
                    echo "<td>" . htmlspecialchars($trajet['lieu_arrivee']) . "</td>";
                    echo "<td>" . htmlspecialchars($trajet['nb_place']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-4 display-flex justify-content-center align-items-center flex-wrap">
        <div>
            <h3>
                <a href="ajout_voiture.php" class="btn btn-success"> Conducteur ? Ajouter une voiture </a></p>
            </h3>
        </div>
        <div>
            <h3>
                <a href="ajout_covoiturage.php" class="btn btn-success"> Ajouter un nouveau trajet </a></p>
            </h3>
        </div>
    </div>
    <div class="container mt-4">
        <h2>Modifier mes informations</h2>
        <form action="modifier_profil.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($_SESSION['user']['prenom']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>



</body>

</html>
<?php
require_once('includes/footer.php');
