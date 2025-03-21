<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Ajouter une tâche - <?php echo htmlspecialchars($project['name']); ?></title> -->
    <link rel="stylesheet" href="../Asset/css/style ajouter taches.css">
    <script src="../Asset/js/ajout_tache.js"></script> 
 
</head>
<body>

    <div class="task-form-container">
        <div class="form-header">
            <h1>Ajouter une tâche</h1>
            <div class="project-info">
                <!-- <h2>Projet : <?php echo htmlspecialchars($project['name']); ?></h2> -->
                <!-- <p>Équipe : <?php echo htmlspecialchars($project['team_name']); ?></p> -->
            </div>
        </div>

        <!-- <?php if (isset($error)): ?> -->
            <div class="error-message">
                <!-- <?php echo htmlspecialchars($error); ?> -->
            </div>
        <!-- <?php endif; ?> -->

        <form method="POST" action="" id="ajout_tache.php">
            <div class="form-group">
                <label for="title">Titre de la tâche *</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="assignee_id">Assigné à *</label>
                    <select id="assignee_id" name="assignee_id" class="form-control" >
                        <option value="">Sélectionner un membre</option>
                        <!-- <?php foreach ($team_members as $member): ?> -->
                            <option value="<?php echo $member['id']; ?>">
                                <!-- <?php echo htmlspecialchars($member['username']); ?> -->
                            </option>
                        <!-- <?php endforeach; ?> -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Statut *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="todo">À faire</option>
                        <option value="in_progress">En cours</option>
                        <option value="review">En révision</option>
                        <option value="done">Terminé</option>
                    </select>
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
                    <label for="estimated_hours">Heures estimées</label>
                    <input type="number" id="estimated_hours" name="estimated_hours" 
                           class="form-control" min="0" step="0.5">
                </div>
            </div>

            <div class="form-group">
                <label for="due_date">Date d'échéance *</label>
                <input type="date" id="due_date" name="due_date" class="form-control" required>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" 
                        onclick="window.location.href='view_project.php?id=<?php echo $project_id; ?>'">
                    Annuler
                </button>
                <button type="submit" class="btn btn-primary">Créer la tâche</button>
            </div>
        </form>
    </div>

</body>
</html>
