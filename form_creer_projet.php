
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau projet</title>
    <link rel="stylesheet" href="../Asset/css/style creer projet.css">
    <script src="../Asset/js/creer_projet.js"></script>
</head>
<body>

    <div class="create-project-container">
        <div class="form-header">
            <h1>Créer un nouveau projet</h1>
            <p>Remplissez les informations ci-dessous pour créer un nouveau projet</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../config/creer_projet.php" id="createProjectForm">
            <div class="form-group">
                <label for="name">Nom du projet *</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="team_id">Équipe *</label>
                    <select id="team_id" name="team_id" class="form-control" >
                        <option value="">Sélectionner une équipe</option>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?php echo $team['id']; ?>">
                                <?php echo htmlspecialchars($team['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Statut *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="planning">Planification</option>
                        <option value="active">Actif</option>
                        <option value="on_hold">En pause</option>
                        <option value="completed">Terminé</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Date de début *</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="end_date">Date de fin *</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="priority">Priorité *</label>
                    <select id="priority" name="priority" class="form-control" required>
                        <option value="low">Basse</option>
                        <option value="medium">Moyenne</option>
                        <option value="high">Haute</option>
                        <option value="critical">Critique</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="budget">Budget</label>
                    <input type="number" id="budget" name="budget" class="form-control" step="0.01">
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="history.back()">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer le projet</button>
            </div>
        </form>
    </div>

   
</body>
</html>
