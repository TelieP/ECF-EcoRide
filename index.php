<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/connect.php';


?>


<!DOCTYPE html>
<lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
    </head>

    <body class="body">
        <!-- <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/image01.jpg" class="d-block w-100" alt="img_carroussel1">
                </div>
                <div class="carousel-item">
                    <img src="images/image02.jpg" class="d-block w-100" alt="img_caroussel2">
                </div>
                <div class="carousel-item">
                    <img src="images/image03.jpg" class="d-block w-100" alt="img_caroussel3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> -->
        <h1> COVOITUREZ AUTREMENT </h1>
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('images/image03.jpg');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Voyagez sans stress</font>
                            </font>
                        </h3>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="https://github.com/twbs.png" alt="Amorçage" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em">
                                    <use xlink:href="#geo-fill"></use>
                                </svg>
                                <small>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Terre</font>
                                    </font>
                                </small>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em">
                                    <use xlink:href="#calendar3"></use>
                                </svg>
                                <small>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">3d</font>
                                    </font>
                                </small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('images/covoiturage.jpg');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Economie partagée</font>
                            </font>
                        </h3>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="images/covoiturage.jpg" alt="Amorçage" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em">
                                    <use xlink:href="#geo-fill"></use>
                                </svg>
                            </li>
                            <li class="d-flex align-items-center">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('images/covoiturage-bonnes-raisons.jpg');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                        <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">penssons à la planète</font>
                            </font>
                        </h3>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <img src="images/site2-1240x526.jpg" alt="Amorçage" width="32" height="32" class="rounded-circle border border-white">
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="25em" height="25em">
                                    <use xlink:href="#geo-fill"></use>
                                </svg>
                                <small>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Nature</font>
                                    </font>
                                </small>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em">
                                    <use xlink:href="#calendar3"></use>
                                </svg>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <h1>A propos de nous </h1>
            <p>
                Chaque semaine, chaque mois. Pour une réunion importante ou juste parce que vous avez
                envie de voir un nouvel endroit.Avec une grande famille.
                Ou un gros bagage. Vers la mer comme vers les pistes de ski.
                Peu importe votre voyage, il sera toujours simple et abordable avec nos bus
            </p>
        </section>
        <section class="py-5 bg-light">
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Votre sécurité est notre priorité</font>
                        </font>
                    </h1>
                    <p class="col-md-8 fs-4" style="align-items: center;">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Chez EcoRide, nous nous sommes fixé comme objectif
                                de construire une communauté de covoiturage fiable et digne de confiance à travers le monde.
                                Rendez-vous sur notre page Confiance et sécurité pour explorer les différentes fonctionnalités
                                disponibles pour covoiturer sereinement.
                            </font>
                        </font>
                    </p>

                </div>
            </div>
        </section>
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Eco covoiturage</font>
                        </font>
                    </h2>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Un geste simple, un impact durable**
                                Le covoiturage écologique, c'est l’opportunité de voyager autrement : moins de voitures sur les routes, moins de pollution,
                                moins de congestion. En optant pour cette alternative, vous faites le choix d’un transport partagé, plus économique, plus écologique
                                et plus convivial. Moins de CO₂, plus de qualité de vie !
                            </font>
                        </font>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Penssons à la nature </font>
                        </font>
                    </h2>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Ou gardez-le léger et ajoutez une bordure pour une définition supplémentaire des limites de votre contenu. Assurez-vous de regarder sous le capot du code HTML source ici car nous avons ajusté l'alignement et la taille du contenu des deux colonnes pour une hauteur égale.</font>
                        </font>
                    </p>
                </div>
            </div>
        </div>



        <!-- <form method="POST" action="list_cov.php" class="form-group">
            <h1>Recherchez un nouveau trajet </h1>
            <div class="mb-3">
                <label for="depart">Départ:</label>
                <input type="text" class="form-control" id="depart" name="lieu_depart">
            </div>
            <div class="mb-3">
                <label for="arrivee">Arrivée:</label>
                <input type="text" class="form-control" id="arrivee" name="lieu_arrivee">
            </div>
            <div class="mb-3">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date_depart">
            </div>

            <button type="submit">Rechercher</button>
        </form> -->

        <?php
        //connexion à la base de données

        // require_once 'includes/connect.php';

        // on vérifie si les critères de recherche sont fournis

        // $sql = "SELECT * FROM `covoiturage` WHERE 1=1";   // condition qui ne filtre rien par defaut 

        // // ajoutons des conditions de recherche

        // if (!empty($_POST['lieu_depart'])) {
        //     $sql .= "AND lieu_depart  LIKE :lieu_depart";
        // }
        // if (!empty($_POST['lieu_arrivee'])) {
        //     $sql .= "AND lieu_arrivee  LIKE :lieu_arrivee";
        // }
        // if (!empty($_POST['date_depart'])) {
        //     $sql .= "AND date_depart  LIKE :date_depart";
        // }

        //on prépare la requete

        // $stmt = $conn->prepare($sql);

        // //lier les parametres si  les champs sont remplis
        // if (!empty($_POST['lieu_depart'])) {
        //     $stmt->bindValue(':lieu_depart', '%' . $_POST['lieu_depart'] . '%', PDO::PARAM_STR);
        // }
        // if (!empty($_POST['lieu_arrivee'])) {
        //     $stmt->bindValue(':lieu_arrivee', '%' . $_POST['lieu_arrivee'] . '%', PDO::PARAM_STR);
        // }
        // if (!empty($_POST['date_depart'])) {
        //     $stmt->bindValue(':date_depart', '%' . $_POST['date_depart'] . '%', PDO::PARAM_STR);
        // }

        //excecuter la requete

        // $stmt->execute();

        // Affichage des resultats de la requete sql

        // $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // if ($resultats) {
        //     foreach ($resultats as $resultat) {
        //         echo "Départ :" . $resultat['lieu_depart'] . "<br>";
        //         echo "Arrivée :" . $resultat['lieu_arrivee'] . "<br>";
        //         echo "Date départ :" . $resultat['date_depart'] . "<br><hr>";
        //     }
        // } else {
        //     echo " Aucun résultat trouvé , veuillez modifiez vos critères de recherche ! ";
        // }

        require_once 'includes/footer.php';

        ?>