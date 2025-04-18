<?php
// Démarrer la session pour récupérer les informations de l'utilisateur connecté
session_start();
require_once 'includes/connect.php';
// Inclure le fichier d'en-tête
include_once('includes/header.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['Id_utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    echo "Vous devez vous connecter pour accéder à cette page.";

    header('Location: connexion.php');
    exit();
}

// Inclure la configuration pour la connexion à la base de données
// include('includes/connect.php');

// Initialisation des variables pour les messages
$error_message = '';
$success_message = '';
var_dump($_SESSION);

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $lieu_depart = $_POST['lieu_depart'];
    $lieu_arrivee = $_POST['lieu_arrivee'];
    $heure_depart = $_POST['heure_depart'];
    $date_depart = $_POST['date_depart'];
    $nb_place = $_POST['nb_place'];
    $prix_personne = $_POST['prix_personne'];
    $user_id = $_SESSION['Id_utilisateur'];

    // Validation des champs
    if (empty($lieu_depart) || empty($lieu_arrivee) || empty($date_depart) || empty($nb_place)) {
        $error_message = "Tous les champs sont obligatoires.";
    } else {
        try {
            // Insérer le covoiturage dans la base de données
            $stmt = $conn->prepare("INSERT INTO covoiturage (Id_utilisateur, lieu_depart, lieu_arrivee, date_depart, nb_place, heure_depart, prix_personne) VALUES (:Id_utilisateur, :lieu_depart, :lieu_arrivee, :date_depart, :nb_place, :prix_personne , :heure_depart, :prix_personne)");

            // Lier les paramètres
            $stmt->bindValue(':Id_utilisateur', $_SESSION['ID_utilisateur']);
            $stmt->bindValue(':lieu_depart', $lieu_depart);
            $stmt->bindValue(':lieu_arrivee', $lieu_arrivee);
            $stmt->bindValue(':date_depart', $date_depart);
            $stmt->bindValue(':nb_place', $nb_place);
            $stmt->bindValue(':prix_personne', $prix_personne);
            $stmt->bindValue(':heure_depart', $heure_depart);

            // Exécuter la requête
            $stmt->execute();

            // Message de succès
            $success_message = "Covoiturage ajouté avec succès !";
        } catch (PDOException $e) {
            // Gestion des erreurs
            $error_message = "Erreur lors de l'ajout du covoiturage : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Nouveau Covoiturage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <h1>Créer un Nouveau Trajet de Covoiturage</h1>

    <!-- Affichage des messages d'erreur et de succès -->
    <?php if ($error_message): ?>
        <div style="color: red;"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <div style="color: green;"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>

    <!-- Formulaire de création de covoiturage -->
    <form method="POST" action="" class="form-group">
        <label for="lieu_depart">Ville de départ :</label>
        <input type="text" id="lieu_depart" name="lieu_depart" value="<?php echo htmlspecialchars($lieu_depart ?? ''); ?>" required><br><br>

        <label for="lieu_arrivee">Ville d'arrivée :</label>
        <input type="text" id="lieu_arrivee" name="lieu_arrivee" value="<?php echo htmlspecialchars($lieu_arrivee ?? ''); ?>" required><br><br>

        <label for="date_depart">Date de départ (format YYYY-MM-DD HH:MM:SS) :</label>
        <input type="text" id="date_depart" name="date_depart" value="<?php echo htmlspecialchars($date_depart ?? ''); ?>" required><br><br>

        <label for="date_depart">Heure de départ (format HH:MM) :</label>
        <input type="text" id="heure_depart" name="heure_depart" value="<?php echo htmlspecialchars($heure_depart ?? ''); ?>" required><br><br>

        <label for="places_disponibles">Nombre de places disponibles :</label>
        <input type="number" id="places_disponibles" name="nb_place" value="<?php echo htmlspecialchars($places_disponibles ?? ''); ?>" required><br><br>


        <label for="prix_personne">Prix par personne :</label>
        <input type="number" id="prix_personne" name="prix_personne" value="<?php echo htmlspecialchars($prix_personne ?? ''); ?>" required><br><br>


        <button type="submit">Créer le covoiturage</button>
    </form>

</body>

</html>