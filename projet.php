<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets</title>
    <link rel="stylesheet" href="../Asset/css/style projet.css">
    <script src="../Asset/js/projet.js"></script>
</head>
<body>

    <div class="container">
        <?php include 'includes/sidebar.php'; ?>

        <main class="projects-container">
            <!-- <?php if ($message): ?> -->
                <div class="alert alert-success">
                    <!-- <?php echo htmlspecialchars($message); ?> -->
                </div>
            <!-- <?php endif; ?> -->

            <div class="projects-header">
                <h1>Projets</h1>
                <button class="btn btn-primary" onclick="showNewProjectModal()">
                    Nouveau Projet
                </button>
            </div>

            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <div class="project-header">
                            <h3 class="project-title">
                                <?php echo htmlspecialchars($project['name']); ?>
                            </h3>
                            <span class="project-status status-<?php echo $project['status']; ?>">
                                <?php echo ucfirst($project['status']); ?>
                            </span>
                        </div>

                        <p class="project-description">
                            <?php echo htmlspecialchars(substr($project['description'], 0, 100)) . '...'; ?>
                        </p>

                        <div class="project-progress">
                            <!-- <?php
                            $progress = $project['total_tasks'] > 0 
                                ? ($project['completed_tasks'] / $project['total_tasks']) * 100 
                                : 0;
                            ?> -->
                            <!-- <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo $progress; ?>%"></div>
                            </div> -->
                            <span class="progress-text">
                                <?php echo $project['completed_tasks']; ?>/<?php echo $project['total_tasks']; ?> tâches
                            </span>
                        </div>

                        <div class="project-meta">
                            <span>Équipe: <?php echo htmlspecialchars($project['team_name']); ?></span>
                            <div class="project-actions">
                                <button class="btn btn-outline" onclick="showProjectActions(<?php echo $project['id']; ?>)">
                                    Actions
                                </button>
                                <div id="actions-<?php echo $project['id']; ?>" class="actions-menu">
                                    <a href="project-details.php?id=<?php echo $project['id']; ?>">Voir détails</a>
                                    <a href="#" onclick="showEditProjectModal(<?php echo $project['id']; ?>)">Modifier</a>
                                     <a href="#" onclick="deleteProject(<?php echo $project['id']; ?>)">Supprimer</a>
                                </div>
                            </div> 
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <!-- Modal pour nouveau projet -->
    <div id="newProjectModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="hideNewProjectModal()">&times;</span>
            <h2>Nouveau Projet</h2>
            <form id="newProjectForm" method="POST" action="projects.php?action=new">
                <div class="form-group">
                    <label for="name">Nom du projet</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="team_id">Équipe</label>
                    <select id="team_id" name="team_id" class="form-control" required>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?php echo $team['id']; ?>">
                                <?php echo htmlspecialchars($team['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Statut</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="planning">Planification</option>
                        <option value="active">Actif</option>
                        <option value="on_hold">En pause</option>
                        <option value="completed">Terminé</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="priority">Priorité</label>
                    <select id="priority" name="priority" class="form-control" required>
                        <option value="low">Basse</option>
                        <option value="medium">Moyenne</option>
                        <option value="high">Haute</option>
                        <option value="critical">Critique</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_date">Date de début</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="end_date">Date de fin</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="budget">Budget</label>
                    <input type="number" id="budget" name="budget" class="form-control" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Créer le projet</button>
            </form>
        </div>
    </div>

</body>
</html>
