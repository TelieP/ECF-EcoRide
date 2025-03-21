<?php
require_once 'includes/connect.php';
// Inclure le fichier d'en-tête
include_once('includes/header.php');
echo " LISTE DES COVOITURAGES DISPONIBLES "
?>
<div class="container">
    <div class="ride-card" style="opacity: 1; transform: translateY(0px);">
        <div class="ride-locations">
            <div class="departure">
                <i class="fas fa-map-marker-alt"></i>
                <span>Paris</span>
            </div>
            <div class="arrival">
                <i class="fas fa-map-marker"></i>
                <span>Lille</span>
            </div>
        </div>

        <div class="driver-info">
            <img src="/assets/uploads/profile_67d47df676940.jpg" alt="Photo du conducteur" class="driver-photo">
            <div class="driver-details">
                <h3>Anes Amri</h3>
                <div class="rating">
                    <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i> <span>(0.0) - 0 avis</span>
                </div>
            </div>
        </div>

        <div class="ride-details">
            <div class="ride-info">
                <div class="departure-time">
                    <i class="fas fa-clock"></i>
                    <span>14:00</span>
                </div>
                <div class="seats-info">
                    <i class="fas fa-user"></i>
                    <span>2 places</span>
                </div>
            </div>
            <div class="ride-price-action">
                <div class="price-value">10.00 €</div>
                <a href="/detail-covoiturage?id=2" class="btn btn-secondary">Voir</a>
            </div>
        </div>
    </div>
</div>
<?php
// Inclure le fichier de pied de page
include_once('includes/footer.php');
?>