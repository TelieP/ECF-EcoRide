// fonction qui permet de démarrer un trajet
function startCovoit() {
    const startButtons = document.getElementsByClassName('start_cov');
    startButtons.forEach((startButton) => {
        startButton.addEventListener('click', () => {
            alert("Le trajet a démarré passez un bon voyage!");
        })
    })
}