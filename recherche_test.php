<?php
require_once('includes/connect.php');
require_once('includes/header.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Covoiturages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center"><i class="fas fa-car-side"></i> Rechercher un covoiturage</h2>
        <form action="resultats.php" method="GET" class="mt-4">
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-map-marker-alt"></i> Ville de départ</label>
                <input type="text" name="depart" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-map-marker-alt"></i> Ville d'arrivée</label>
                <input type="text" name="arrivee" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="far fa-calendar-alt"></i> Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Rechercher</button>
        </form>
    </div>
</body>

</html>