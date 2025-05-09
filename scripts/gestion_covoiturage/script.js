/**
 * Change le statut d'un coivturage
 */
function startOrStopCovoit() {
    // Récupération de tous les boutons ayant la classe start_covoit
    const startButtons = document.querySelectorAll('.start_cov');
    // Pour chaque boutons, ajout d'un listener
    startButtons.forEach((startButton) => {
        startButton.addEventListener('click', (event) => {
            const clickedButton = event.currentTarget
            // On vérifie si on démarre ou on stoppe le trajet
            let startOrStop = "D"
            if (clickedButton.innerText == "Stopper") {
                startOrStop = "T"
                // TODO Supprimer le trajet de la DB
            } else {
                clickedButton.innerText = "En cours"
                // TODO Mettre "En cours" dans le DB
            }
            updateStatus(startOrStop)
        });
    });
}
// Ajout des listeners
startOrStopCovoit();

/**
 * Change le statut du covoiturage en BDD + envoi mail
 * @param {string} startOrStop Le statut : D pour Démarré, T pour Terminé
 */
function updateStatus(startOrStop) {
    $.ajax({
    // Fichier qui est appelé
    url: "scripts/gestion_covoiturage/gestion_covoiturage.php",
    // Méthode POST pour mettre à jour la DB
    method: "POST",
    // On passe la variable status (D ou T)
    data: { startOrStop: startOrStop },
    success: function (data) {
        try {
            // Aficher un message (debug) => enlever quand le TODO sera terminé
            alert(data)
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
