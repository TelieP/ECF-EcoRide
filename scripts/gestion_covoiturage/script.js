/**
 * Change le statut d'un coivturage
 */
function startCovoit() {
    const startButtons = document.querySelectorAll('.start_cov'); // renvoie un NodeList
    startButtons.forEach((startButton) => {
        startButton.addEventListener('click', () => {
            // alert("Le trajet a démarré, passez un bon voyage!");
            // TODO :  Appel à la fonction updateStatus(status)
        });
    });
}
startCovoit();

/**
 * Change le statut du covoiturage en BDD
 * @param {string} status Le status : D pour Démarré, T pour Terminé
 */
function updateStatus(status) {
    $.ajax({
    // Fichier qui est appelé
    url: "/scripts/gestion_covoiturage/gestion_covoiturage.php",
    // Méthode GET car on récupère des données
    method: "POST",
    // On passe la variable status (D ou T)
    data: { status: status },
    success: function (data) {
        try {
            // Aficher un message 
            console.log("OK")
            // TODO : envoyer mail
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
}
