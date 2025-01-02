
<?php
session_start();
require_once 'includes/connect.php'; // Connexion à la base de données

// Initialisation des variables pour les filtres
$ville_depart = isset($_GET['ville_depart']) ? $_GET['ville_depart'] : '';
$ville_arrivee = isset($_GET['ville_arrivee']) ? $_GET['ville_arrivee'] : '';
$date_depart = isset($_GET['date_depart']) ? $_GET['date_depart'] : '';

// Construction de la requête SQL
$sql = "SELECT t.id, t.ville_depart, t.ville_arrivee, t.date_depart, t.places_disponibles, t.prix, u.nom AS conducteur_nom, u.prenom AS conducteur_prenom
        FROM trajets t
        JOIN utilisateurs u ON t.utilisateur_id = u.id
        WHERE 1";

// Ajout des conditions de filtrage selon les champs de recherche
if (!empty($ville_depart)) {
    $sql .= " AND t.ville_depart LIKE ?";
}
if (!empty($ville_arrivee)) {
    $sql .= " AND t.ville_arrivee LIKE ?";
}
if (!empty($date_depart)) {
    $sql .= " AND t.date_depart >= ?";
}

// Préparer et exécuter la requête
$stmt = $conn->prepare($sql);

// Paramétrer les valeurs de filtre
$paramIndex = 1;
if (!empty($ville_depart)) {
    $stmt->bindValue($paramIndex++, '%' . $ville_depart . '%');
}
if (!empty($ville_arrivee)) {
    $stmt->bindValue($paramIndex++, '%' . $ville_arrivee . '%');
}
if (!empty($date_depart)) {
    $stmt->bindValue($paramIndex++, $date_depart . ' 00:00:00');
}

$stmt->execute();

// Récupérer les résultats
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Trajets</title>
</head>
<body>

<h1>Rechercher un trajet de covoiturage</h1>

<form method="get" action="rechercher_trajets.php">
    <label for="ville_depart">Ville de départ :</label>
    <input type="text" name="ville_depart" id="ville_depart" value="<?= htmlspecialchars($ville_depart) ?>"><br><br>

    <label for="ville_arrivee">Ville d'arrivée :</label>
    <input type="text" name="ville_arrivee" id="ville_arrivee" value="<?= htmlspecialchars($ville_arrivee) ?>"><br><br>

    <label for="date_depart">Date de départ :</label>
    <input type="date" name="date_depart" id="date_depart" value="<?= htmlspecialchars($date_depart) ?>"><br><br>

    <button type="submit">Rechercher</button>
</form>

<h2>Résultats de la recherche</h2>

<?php if (empty($trajets)): ?>
    <p>Aucun trajet trouvé avec les critères spécifiés.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Ville de départ</th>
                <th>Ville d'arrivée</th>
                <th>Date de départ</th>
                <th>Places disponibles</th>
                <th>Prix</th>
                <th>Conducteur</th>
                <th>Réserver</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trajets as $trajet): ?>
                <tr>
                    <td><?= htmlspecialchars($trajet['ville_depart']) ?></td>
                    <td><?= htmlspecialchars($trajet['ville_arrivee']) ?></td>
                    <td><?= htmlspecialchars($trajet['date_depart']) ?></td>
                    <td><?= htmlspecialchars($trajet['places_disponibles']) ?></td>
                    <td><?= number_format($trajet['prix'], 2, ',', ' ') ?> €</td>
                    <td><?= htmlspecialchars($trajet['conducteur_nom']) ?> <?= htmlspecialchars($trajet['conducteur_prenom']) ?></td>
                    <td>
                        <?php if ($trajet['places_disponibles'] > 0): ?>
                            <a href="reserver_trajet.php?trajet_id=<?= $trajet['id'] ?>">Réserver</a>
                        <?php else: ?>
                            <span>Complet</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
