<?php
session_start();
include 'includes/header.php';
include 'includes/connect.php';
// var_dump($_SESSION);
// die;
// On vérifie si l'utilisateur est connecté et a le rôle d'administrateur
if (isset($_SESSION['user']) && $_SESSION['user']['Id_utilisateur'] == 7) {
    // On récupére les statistiques depuis la base de données
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
} else {
    // L'utilisateur n'est pas un administrateur, rediriger vers la page de connexion ou d'accueil
    header('Location: index.php');
    exit();
}
?>
<?php
include 'includes/fonctions.php';
//permet de modérer les avis des utilisateurs
echo 'UTILISATEURS INSCRITS SUR LE site:';
$utilisateurs = afficherUtilisateurs($conn);
foreach ($utilisateurs as $utilisateur) {
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . htmlspecialchars($utilisateur['nom']) . ' ' . htmlspecialchars($utilisateur['prenom']) . '</h5>';
    echo '<p class="card-text">Email: ' . htmlspecialchars($utilisateur['email']) . '</p>';
    echo '<p class="card-text">Téléphone: ' . htmlspecialchars($utilisateur['telephone']) . '</p>';
    echo '<p class="card-text">Adresse: ' . htmlspecialchars($utilisateur['adresse']) . '</p>'; ?>
    <button class="btn btn-danger" id="suppr_user" data-bs-toggle="collapse" data-bs-target="#avis<?php echo $utilisateur['Id_utilisateur']; ?>">Supprimer</button>
    <!-- lier le bouton supprimer à la fonction supprimerUtilisateur -->

    <bouton class="btn btn-primary" id="View_avis_user" data-bs-toggle="collapse" data-bs-target="#avis' . $utilisateur['Id_utilisateur'] . '">Afficher les avis</button>
    <?php
    // 

    echo '</div>';
    echo '</div>';
}




    ?>


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