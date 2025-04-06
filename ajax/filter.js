/**
 * Récupère les trajets écolo (appelé depuis recherche.php sur l'événement onchange)
 */
function getEnvironmentallyFriendlyCarSharing() {
  // On récupère la checkbox => peut être remplacé par document.getElementById (mais autant profiter de jQuery :))
  const checkBox = $("#ecological");
  // On regarde si elle est cochée ou non
  // Si elle est cochée, on met 1 dans la variable ecological, 0 sinon
  let ecological = checkBox[0].checked ? 1 : 0;
  $.ajax({
    // Fichier qui est appelé
    url: "filter.php",
    // Méthode GET car on récupère des données
    method: "GET",
    // On passe la variable ecological (0 ou 1)
    data: { ecological: ecological },
    success: function (data) {
      try {
        // Si pas d'erreur : log dans la console
        console.log(data);
      } catch (e) {
        // Le drame ! Mais ça ne se produira pas :)
        console.error("Erreur JSON :", e);
      }
    },
    error: function (xhr, status, error) {
      // Erreur Ajax
      console.error("Erreur AJAX :", status, error, xhr.responseText);
    }
  })
};

/** fonction pour recuperer les trajets par prix croissant ou décroissant 
 * appelé depuis recherche.php sur l'événement onchange
 **/
function getlowprice() {
  const checkBox = $("#lowprice");
  let lowprice = checkBox[0].checked ? 1 : 0;

  $.ajax({
    url: "filter.php",
    method: "GET",
    data: { lowprice: lowprice },
    success: function (data) {
      try {
        displaySortedCovoit(data);
      } catch (e) {
        console.error("Erreur JSON :", e);
      }
    },
    error: function (xhr, status, error) {
      // Erreur Ajax
      console.error("Erreur AJAX :", status, error, xhr.responseText);

    }
  })
}

/**
 * Afficher les trajets triés
 * @param {*} data Les objets trajets
 */
function displaySortedCovoit(data) {
  // On récupère la div
  const trajetsDiv = $(".list-group.mt-4");
  // On vide d'abord les trajets existants
  trajetsDiv.empty();
  data.forEach(covoit => {
    // Construction du covoit
    const divCovoit = "<div class=\"list-group-item list-group-item-action\">"
      + "<h5><i class=\"bi bi-geo-fill\"></i> De " + covoit['lieu_depart'] + "</br><i class=\"bi bi-arrow-down\"></i></br> <i class=\"bi bi-geo-fill\"></i> à " + covoit['lieu_arrivee'] + "</h5>"
      + "<p><i class=\"bi bi-calendar3\"></i> Date : + " + covoit['date_depart'] + " à " + covoit['heure_depart'] + "</p>"
      + "<p> </i> Conducteur : " + covoit['nom'] + " " + covoit['prenom'] + "<img src=" + covoit['photo'] + " alt=\"Conducteur\" class=\"img-fluid\" style=\"width: 75px; height: 75px; border-radius: 50%;\"></p>"
      + "<p><i class=\"bi bi-car-front-fill\"></i> Véhicule : " + covoit['modele'] + "</p>"
      + "<p><i class=\"bi bi-cash-coin\"></i> Prix : " + covoit['prix_personne'] + "€</p>"
      + "<p><i class=\"bi bi-person-check-fill\"></i> Places restantes : " + covoit['nb_place'] + "</p>"
      + "<a href=\"reservation_cov.php?id=" + covoit['Id_covoiturage'] + "\" class=\"btn btn-success\"><i class=\"fas fa-check\"></i> Réserver</a>"
      + "<a href=\"reservation_cov.php?id=" + covoit['Id_covoiturage'] + "\" class=\"btn btn-success stretched-link\"><i class=\"fas fa-check\"></i> VOIR</a>"
      + "</div>"
      // On ajoute à la div principale
      trajetsDiv.append(divCovoit);
  })
}