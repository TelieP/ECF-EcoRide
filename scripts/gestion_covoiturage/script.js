//lier le fichier scripts.js au fichier profil.php


// fonction qui permet créer un bouton démarer pour chaque trajet et envoyer un mail au covoitureur

    function toggleButton() {
        // on recupère l'id du bouton
        const button = document.getElementById('toggleButton');
        button.addEventListener('click', function() {
          alert("Le trajet a démarré passez un bon voyage!");
        });
    }
    toggleButton();
    
    // function sendEmail() {
    //     // création  de l'UrL mailto pour envoyer un mail au covoitureur
    //     const mailtoLink = "mailto:destinataire@exmple.com?subject=Objet du mail&body=Corps du mail";
    //     // on ouvre l'application de messagerie de l'utlisateur pour envoyer le mail
    //     windows.location.href = mailtoLink;
    //     // on affiche un message de confirmation
    //     alert("Un mail a été envoyé au covoitureur !");
    // }

  

