// fonction qui permet de démarrer un trajet
function startCovoit() {
    const startButtons = document.querySelectorAll('.start_cov'); // renvoie un NodeList
    startButtons.forEach((startButton) => {
        startButton.addEventListener('click', () => {
            alert("Le trajet a démarré, passez un bon voyage!");
        });
    });
}
startCovoit();