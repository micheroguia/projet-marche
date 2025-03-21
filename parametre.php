<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link rel="stylesheet" href="../Asset/css/style parametre.css">
    <script src="../Asset/js/param.js"></script>
</head>
<body>
    <div class="container">
        <?php include 'includes/sidebar.php'; ?>

        <main class="settings-container">
            <h1>Paramètres</h1>

            <?php if ($message): ?>
                <div class="<?php echo strpos($message, 'Erreur') !== false ? 'error-message' : 'success-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="settings-section">
                <h2>Profil</h2>
                <form method="POST" action="settings.php">
                    <input type="hidden" name="action" value="update_profile">
                    
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" 
                               class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" 
                               class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="timezone">Fuseau horaire</label>
                        <select id="timezone" name="timezone" class="form-control">
                            <?php
                            $timezones = DateTimeZone::listIdentifiers();
                            foreach ($timezones as $timezone) {
                                $selected = $timezone === $user['timezone'] ? 'selected' : '';
                                echo "<option value=\"$timezone\" $selected>$timezone</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
                </form>
            </div>

            <div class="settings-section">
                <h2>Notifications</h2>
                <form method="POST" action="settings.php">
                    <input type="hidden" name="action" value="update_profile">
                    
                    <div class="notification-option">
                        <input type="checkbox" id="notify_tasks" name="notifications[]" 
                               value="tasks" <?php echo in_array('tasks', $notifications) ? 'checked' : ''; ?>>
                        <label for="notify_tasks">Nouvelles tâches assignées</label>
                    </div>

                    <div class="notification-option">
                        <input type="checkbox" id="notify_comments" name="notifications[]" 
                               value="comments" <?php echo in_array('comments', $notifications) ? 'checked' : ''; ?>>
                        <label for="notify_comments">Nouveaux commentaires</label>
                    </div>

                    <div class="notification-option">
                        <input type="checkbox" id="notify_deadlines" name="notifications[]" 
                               value="deadlines" <?php echo in_array('deadlines', $notifications) ? 'checked' : ''; ?>>
                        <label for="notify_deadlines">Rappels d'échéances</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour les notifications</button>
                </form>
            </div>

            <div class="settings-section">
                <h2>Changer le mot de passe</h2>
                <form method="POST" action="settings.php">
                    <input type="hidden" name="action" value="change_password">
                    
                    <div class="form-group">
                        <label for="current_password">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label>
                        <input type="password" id="new_password" name="new_password" 
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" 
                               class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                </form>
            </div>
        </main>
    </div>

    
</body>
</html>
