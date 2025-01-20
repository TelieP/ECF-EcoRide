<?php
require_once 'includes/header.php';
//require_once 'includes/connect.php';


?>


<!DOCTYPE html>
<lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
    </head>

    <body>
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/image01.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/image02.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/image03.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div class="container-lg">
        <div>
            <div class="card" style="width: 18rem;">
                <img src="images/covoiturage.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="images/covoiturage.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <section>
            <h1>A propos de nous </h1>
            <p>
                **Covoiturage Écologique : Roulez Ensemble pour un Avenir Plus Vert**

                Bienvenue sur notre plateforme de covoiturage écologique, où chaque trajet compte pour la planète ! En choisissant de partager votre voiture avec d’autres, vous réduisez non seulement votre empreinte carbone, mais vous contribuez activement à la préservation de l'environnement. Ensemble, nous pouvons rendre chaque kilomètre plus responsable et chaque déplacement plus solidaire.

                **Un geste simple, un impact durable**
                Le covoiturage écologique, c'est l’opportunité de voyager autrement : moins de voitures sur les routes, moins de pollution, moins de congestion. En optant pour cette alternative, vous faites le choix d’un transport partagé, plus économique, plus écologique et plus convivial. Moins de CO₂, plus de qualité de vie !

                **Des trajets au quotidien, pour la planète**
                Que ce soit pour vos trajets domicile-travail, vos déplacements ponctuels ou vos voyages longue distance, nous vous offrons une solution pratique et flexible pour réduire votre empreinte écologique. Partagez votre voiture, trouvez des trajets proches de chez vous et connectez-vous à des conducteurs ou passagers qui partagent les mêmes valeurs écologiques.

                **Pourquoi choisir notre covoiturage écologique ?**
                - **Réduction des émissions de CO₂** : Chaque passager qui monte dans votre véhicule permet de diminuer le nombre de voitures sur la route.
                - **Économie partagée** : Vous réduisez vos coûts de transport tout en permettant à d’autres de voyager à moindre prix.
                - **Communauté solidaire** : Rejoignez un réseau de voyageurs soucieux de l’environnement, d’échange et de convivialité.
                - **Plateforme simple et sécurisée** : Grâce à notre interface intuitive, trouvez facilement des trajets, communiquez avec vos co-voyageurs et partez en toute sérénité.

                **Agir aujourd'hui pour un demain plus vert**
                Nous croyons qu’une petite action peut entraîner un grand changement. En choisissant notre service de covoiturage écologique, vous devenez acteur de la transition énergétique tout en bénéficiant d'une mobilité plus économique et plus responsable. Faites la différence dès aujourd’hui, pour demain !

                Rejoignez la communauté et roulez vers un futur plus vert.
            </p>
        </section>
        <form method="POST" action="list_cov.php" class="formulaire_find_cov">
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
        </form>

        <?php
        //connexion à la base de données

        require_once 'includes/connect.php';

        // on vérifie si les critères de recherche sont fournis

        $sql = "SELECT * FROM `covoiturage` WHERE 1=1";   // condition qui ne filtre rien par defaut 

        // ajoutons des conditions de recherche

        if (!empty($_POST['lieu_depart'])) {
            $sql .= "AND lieu_depart  LIKE :lieu_depart";
        }
        if (!empty($_POST['lieu_arrivee'])) {
            $sql .= "AND lieu_arrivee  LIKE :lieu_arrivee";
        }
        if (!empty($_POST['date_depart'])) {
            $sql .= "AND date_depart  LIKE :date_depart";
        }

        //on prépare la requete

        $stmt = $conn->prepare($sql);

        //lier les parametres si  les champs sont remplis
        if (!empty($_POST['lieu_depart'])) {
            $stmt->bindValue(':lieu_depart', '%' . $_POST['lieu_depart'] . '%', PDO::PARAM_STR);
        }
        if (!empty($_POST['lieu_arrivee'])) {
            $stmt->bindValue(':lieu_arrivee', '%' . $_POST['lieu_arrivee'] . '%', PDO::PARAM_STR);
        }
        if (!empty($_POST['date_depart'])) {
            $stmt->bindValue(':date_depart', '%' . $_POST['date_depart'] . '%', PDO::PARAM_STR);
        }

        //excecuter la requete

        $stmt->execute();

        // Affichage des resultats de la requete sql

        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($resultats) {
            foreach ($resultats as $resultat) {
                echo "Départ :" . $resultat['lieu_depart'] . "<br>";
                echo "Arrivée :" . $resultat['lieu_arrivee'] . "<br>";
                echo "Date départ :" . $resultat['date_depart'] . "<br><hr>";
            }
        } else {
            echo " Aucun résultat trouvé , veuillez modifiez vos critères de recherche ! ";
        }

        require_once 'includes/footer.php';

        ?>