
<?php
/**
     * @param string $email The email
     * @param string $password The password
     * @return boolean true if the connection is a success
     */
    public function login($email, $password): bool
    {
        $user = $this->db->prepare('SELECT * FROM personnel WHERE email = ?', [$email], null, true);
        if ($user) {
            $passwordHash = $user->password;
            if (password_verify($password, $passwordHash)) {
                $_SESSION['auth']['id'] = $user->personnel_id;
                $_SESSION['auth']['user'] = $user->name;
                $_SESSION['auth']['role'] = $user->role_id;
                return true;
            }
        }
        return false;
    }
    ?>

    <?php 
    // ma fonction php 
    
session_start(); // Démarre une session pour pouvoir utiliser $_SESSION

function authenticate_user($username, $password) {
    // Exemple de données d'authentification (à remplacer par des données réelles ou une base de données)
    $valid_username = "admin"; 
    $valid_password = "12345"; // Utilisez ici un mot de passe haché dans une vraie application !

    // Vérification des informations d'identification
    if ($username === $valid_username && $password === $valid_password) {
        // L'utilisateur est authentifié, démarrons une session
        $_SESSION['username'] = $username;
        $_SESSION['authenticated'] = true;
        return true;
    } else {
        return false;
    }
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authentification de l'utilisateur
    if (authenticate_user($username, $password)) {
        // Redirection vers la page protégée
        header("Location: protected_page.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

    
    
    
    
    
    
    