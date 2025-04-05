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
function getLowPrice() {
  const checkBox = $("#lowPrice");
  let lowPrice = checkBox[0].checked ? 1 : 0;
  $.ajax({
    url: "filter.php",
    method: "GET",
    data: { lowPrice: lowPrice },
    success: function (data) {
      try {
        console.log(data);
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
