<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/connect.php';
?>

<head>
    <style>
        /* Style pour positionner le formulaire */
        .form-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            z-index: 10;
            width: 50%;
        }
    </style>
</head>

<body>
    <div id="carouselExampleAutoplaying" class="carousel slide position-relative" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/image01.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="images/image02.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="images/image03.jpg" class="d-block w-100" alt="Image 3">
            </div>
        </div>

        <!-- Boutons précédent/suivant -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>

        <!-- Formulaire dans le carousel -->
        <form action="recherche.php" method="GET" class="form-overlay">
            <h4 class="text-center">Rechercher un trajet</h4>
            <div class="row g-3">
                <div class="col">
                    <label for="depart" class="form-label">Ville de départ</label>
                    <input type="text" class="form-control" id="depart" name="depart" required placeholder="Ville de départ">
                </div>
                <div class="col">
                    <label for="arrivee" class="form-label">Ville d'arrivée</label>
                    <input type="text" class="form-control" id="arrivee" name="arrivee" required placeholder="Ville d'arrivée">
                </div>
                <div class="col">
                    <label for="date" class="form-label">Date du trajet</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>
    </div>

    <main>

        <section class="py-4 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h2 class="fw-light">Voyager n'a jamais été aussi facile</h2>
                    <p class="lead text-body-secondary">Diminuez votre empreinte carbone en partageant vos trajets. Chaque covoiturage permet d'éviter jusqu'à 2,2 kg de CO2 par personne et par trajet,
                        contribuant activement à la préservation de notre planète.</br>
                        Partagez les frais de transport et économisez jusqu'à 70% sur vos déplacements quotidiens. Entre carburant, entretien et stationnement,
                        le covoiturage représente une solution intelligente pour votre portefeuille.</p>

                </div>
            </div>
        </section>

        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <h2> NOS ENGAGEMENTS </h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="images/covoiturage-bonnes-raisons.jpg" alt="" width="100%" height="225">
                            <div class="card-body">
                                <p class="card-text">Nous développons un réseau de confiance et de sérénité pour s'assurer que vous soyez à l'aise et en sécurité durant votre voyage </br></br></br></br></br></p>
                                <div class="d-flex justify-content-between align-items-center">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="images/ecologie.jpg" alt="" width="100%" height="225">
                            <div class="card-body">
                                <p class="card-text">Transformez vos trajets en moments d'échange et de partage. Le covoiturage favorise les rencontres enrichissantes et permet de tisser des liens avec des personnes partageant votre itinéraire et potentiellement vos centres d'intérêt..</p>
                                <div class="d-flex justify-content-between align-items-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="images/secure-covoit.jpg" alt="" width="100%" height="225">
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-body-secondary">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Change the background</h2>
                    <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
                    <button class="btn btn-outline-light" type="button">Example button</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Add borders</h2>
                    <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>

                </div>
            </div>
        </div>


    </main>

    <?php
    require_once 'includes/footer.php';

    ?>
    <a href="deconnexion.php">Se Déconnecter</a>