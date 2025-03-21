
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
            <p>Inscriver pour avoir un compte</p>
        </div>



        <form method="POST" action="../config/submit.php">
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

            <div class="form-group">
                <label for="Statut">Role</label>
                <input type="text" id="Role" name="ROLE" required>
            </div>

            <div class="form-group">
                <label for="Statut">Statut</label>
                <input type="text" id="Statut" name="STATUS_USER" required>
            </div>
            
            <div class="form-options">
                <label class="checkbox-label">
                   
                </label>
                
            </div>

             <button type="submit" class="btn-login">S'inscrire</button>
        </form>

         <p class="auth-footer">
            Déja un compte ? <a href="form_connexion.php" class="auth-link">Se connecter</a>
        </p>
    </div>

   
</body>
</html>