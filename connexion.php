<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/connect.php';

if (!empty($_POST)) {

    $email = $_POST["email"];
    $password = $_POST['mot_de_passe'];

    if (isset($email, $password)) {
        //on verifie que le mail est un vrai mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Adresse email invalide : ' . $email);
        }
        // on se connecte à la base de données
        // on prepare la requete
        $sql = "SELECT * FROM `utilisateur` WHERE `email` = :email";
        $query = $conn->prepare($sql);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            die('Utilisateur inconnu');
        }
        if (!password_verify($password, $user['password'])) {
            echo '<script type="text/javascript">window.alert("Mot de passe incorrect");</script>';
        } else {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        }
    }
}
?>
<h1>Connexion</h1>
<form method="post" class="form-group"><br>
    Email: <input type="email" name="email" id="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>
    <button type="submit">Se connecter</button>
    <a href="inscription.php">Pas encore inscrit ?</a>
</form>

<?php
require_once 'includes/footer.php';
?>