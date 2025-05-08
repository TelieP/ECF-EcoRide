/**
 * Change le statut d'un coivturage
 * @param {string} startOrStop : D pour Démarrer, S pour Stopper
 */
function startOrStopCovoit(startOrStop) {
    // Récupération de tous les boutons ayant la classe start_covoit
    const startButtons = document.querySelectorAll('.start_cov');
    // Pour chaque boutons, ajout d'un listener
    startButtons.forEach((startButton) => {
        startButton.addEventListener('click', () => {
            // alert("Le trajet a démarré, passez un bon voyage!");
            // TODO :  Appel à la fonction updateStatus(startOrStop)
        });
    });
}
// Ajout des listeners
startCovoit();

/**
 * Change le statut du covoiturage en BDD + envoi mail
 * @param {string} startOrStop Le statut : D pour Démarré, T pour Terminé
 */
function updateStatus(startOrStop) {
    $.ajax({
    // Fichier qui est appelé
    url: "/scripts/gestion_covoiturage/gestion_covoiturage.php",
    // Méthode GET car on récupère des données
    method: "POST",
    // On passe la variable status (D ou T)
    data: { startOrStop: startOrStop },
    success: () => {
        try {
            // Aficher un message (debug)
            console.log("OK")
            // TODO : MAJ DB + envoyer mail
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
