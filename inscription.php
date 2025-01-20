<?php
session_start();
require_once 'includes/connect.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_ARGON2ID);
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $naissance = $_POST['naissance'];
    $photo = $_POST['photo'];
    $pseudo = $_POST['pseudo'];
    try {
        $stmt = $conn->prepare("SELECT * FROM `utilisateur` WHERE email = :email"); // on vérifie que l'email n'existe pas dejà en base de données
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            echo "Email déjà utilisé.";
        } else {
            // Ajout de l'utilisateur en BDD
            $stmt = $conn->prepare("
                INSERT INTO `utilisateur` (`nom`, `prenom`, `email`, `password`, `telephone`, `adresse`, `date_naissance`, `photo`, `pseudo`) 
                VALUES (:nom, :prenom, :email, :password, :telephone, :adresse, :naissance, :photo, :pseudo)
            ");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':naissance', $naissance, PDO::PARAM_STR);
            $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            if ($stmt->execute()) {
                // On récupère l'id de l'utilisateur inséré et l'id du rôle posté
                $idUtilisateur = $conn->lastInsertId();
                $idRole = $_POST['Id_role'];
                // On insère dans la table *possede* ces 2 informations
                $stmt = $conn->prepare('INSERT INTO `possede` (Id_role, Id_utilisateur) ' .
                    'VALUES (:id_role, :id_utilisateur)');
                $stmt->bindParam(':id_role', $idRole, PDO::PARAM_INT);
                $stmt->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    echo "Inscription réussie !";
                    header('Location: profil.php');
                    exit();
                } else {
                    echo "Erreur lors de l'inscription.";
                }
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<form class="form_inscription" method="post">
    Nom: <input type="text" name="nom" required><br><br>
    Prénom: <input type="text" name="prenom" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Mot de passe: <input type="password" name="pass" required><br><br>
    Téléphone: <input type="number" name="telephone" required><br><br>
    Adresse: <input type="text" name="adresse" required><br><br>
    Date de naissance: <input type="date" name="naissance" required><br><br>
    Photo: <input type="file" name="photo" accept="image/png , image/jpeg"><br><br>
    Pseudo: <input type="text" name="pseudo" required><br><br>
    <?php
    $stmt = $conn->prepare("SELECT Id_role, libelle FROM role");
    $stmt->execute();
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <label for="Id_role">Role :</label>
    <select name="Id_role" id="Id_role">
        <?php
        foreach ($roles as $role) {
        ?>
            <option value="<?php echo $role['Id_role']; ?>"><?php echo $role['libelle']; ?></option>
        <?php
        }
        ?>
    </select> <br><br>

    <button type="submit">S'inscrire</button>
</form>