<?php
include('includes/header.php');
// Démarrer la session et vérifier si l'administrateur est connecté
session_start();
//if (!isset($_SESSION['admin_id'])) {
//   header('Location: connexion.php'); // Rediriger si l'administrateur n'est pas connecté
//  exit();
//}

// Inclure la configuration pour la connexion à la base de données
include('includes/connect.php');

// Récupérer les statistiques depuis la base de données
try {
    // Nombre total de covoiturages
    $stmt = $conn->query("SELECT COUNT(*) AS total_covoiturages FROM covoiturage");
    $totalCovoiturages = $stmt->fetch(PDO::FETCH_ASSOC)['total_covoiturages'];

    // Nombre total d'utilisateurs
    $stmt = $conn->query("SELECT COUNT(*) AS total_utilisateurs FROM utilisateur");
    $totalUtilisateurs = $stmt->fetch(PDO::FETCH_ASSOC)['total_utilisateurs'];
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <h1>Tableau de Bord Administrateur</h1>

    <div>
        <h2>Statistiques</h2>
        <p><strong>Total des Covoiturages :</strong> <?php echo $totalCovoiturages; ?></p>
        <p><strong>Total des Utilisateurs :</strong> <?php echo $totalUtilisateurs; ?></p>
    </div>

    <div style="width: 50%; margin: auto;">
        <canvas id="covoituragesChart"></canvas>
    </div>

    <div style="width: 50%; margin: auto; margin-top: 30px;">
        <canvas id="utilisateursChart"></canvas>
    </div>

    <script>
        // Données pour le graphique des covoiturages
        const covoituragesData = {
            labels: ['Covoiturages'],
            datasets: [{
                label: 'Nombre de covoiturages',
                data: [<?php echo $totalCovoiturages; ?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Données pour le graphique des utilisateurs
        const utilisateursData = {
            labels: ['Utilisateurs'],
            datasets: [{
                label: 'Nombre d\'utilisateurs inscrits',
                data: [<?php echo $totalUtilisateurs; ?>],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };

        // Configuration du graphique des covoiturages
        const covoituragesConfig = {
            type: 'bar',
            data: covoituragesData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Configuration du graphique des utilisateurs
        const utilisateursConfig = {
            type: 'bar',
            data: utilisateursData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Création des graphiques
        new Chart(document.getElementById('covoituragesChart'), covoituragesConfig);
        new Chart(document.getElementById('utilisateursChart'), utilisateursConfig);
    </script>

</body>

</html>