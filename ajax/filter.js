/**
 * Gets the Environmentally-Friendly Covoit
 */
function getEnvironmentallyFriendlyCarSharing() {
  const checkBox = $("#ecological");
  let ecological = checkBox[0].checked ? 1 : 0;
  $.ajax({
    url: "filter.php",//"filter.php?ecological=" + ecological,
    method: "GET",
    data: { ecological: ecological },
    success: function (data) {
      try {
        console.log(data);
      } catch (e) {
        console.error("Erreur JSON :", e);
      }
    },
    error: function (xhr, status, error) {
      console.error("Erreur AJAX :", status, error, xhr.responseText);
    }
  })
};
