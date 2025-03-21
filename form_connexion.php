

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de Projets</title>
     <link rel="stylesheet" href="../Asset/css/style connexion.css"> 
      <script src="../Asset/js/connexion.js"></script> 
    
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <h1>academique corporation</h1>
            <p>Connectez-vous à votre compte</p>
        </div>

       
        <form method="POST" action="../config/connexion.php">
            <div class="form-group">
                <label for="nom">Nom d'utilisateur</label>
                <input type="text" id="nom" name="NAME_USER" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="EMAIL" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="PASSWORD" required>
            </div>

            
            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" id="remember">
                    <span>Se souvenir de moi</span>
                </label>
                <a href="#" class="forgot-password">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <p class="auth-footer">
            Pas encore de compte ? <a href="form_inscription.php" class="auth-link">S'inscrire</a>
        </p>
    </div>

   
</body>
</html>
