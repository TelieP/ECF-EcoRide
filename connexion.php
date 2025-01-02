<?php
session_start();
require_once 'includes/header.php';
require_once 'includes/connect.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->bindParam("s", $email);
    $stmt->execute();
    //$result = $stmt->get_result();
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            header('Location: profil.php');
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }
}
?>

<form method="post"  >
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="mot_de_passe" required><br>
    <button type="submit">Se connecter</button>
</form>

<?php
require_once 'includes/footer.php';
?>
