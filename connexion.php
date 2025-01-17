<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/connect.php';

if (!empty($_POST)) {

    if (isset($_POST["email"], $_POST['mot_de_passe'])) {

        //on verifie que le mail est un vrai mail
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            die('Adresse email invalide');
        }
        // on se connecte à la base de données


        // on prepare la requete
        $sql = "SELECT * FROM `utilisateur` WHERE `email` = :email";
        $query = $conn->prepare($sql);
        $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            die('Utilisateur inconnu');
        }
        if (!password_verify($_POST['mot_de_passe'], $user['password'])) {
            die('Mot de passe incorrect');
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit();
        }
    }
}
?>

<form method="post">
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" required><br>
    <button type="submit">Se connecter</button>
</form>

<?php
require_once 'includes/footer.php';
?>