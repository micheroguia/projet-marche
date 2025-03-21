<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title><?php echo htmlspecialchars($project['name']); ?> - Détails du projet</title> -->
   <link rel="stylesheet" href="../Asset/css/style vue projet.css">
   <script src="../Asset/js/vue_proj.js"></script>
</head>
<body>

    <div class="project-container">
        <div class="project-header">
            <div class="project-title">
                <!-- <h1><?php echo htmlspecialchars($project['name']); ?></h1> -->
                <!-- <span class="project-status status-<?php echo $project['status']; ?>">
                    <?php echo ucfirst($project['status']); ?>
                </span> -->
            </div>

            <div class="project-info">
                <div class="info-item">
                    <label>Équipe</label>
                    <!-- <span><?php echo htmlspecialchars($project['team_name']); ?></span> -->
                </div>
                <div class="info-item">
                    <label>Date de début</label>
                    <!-- <span><?php echo date('d/m/Y', strtotime($project['start_date'])); ?></span> -->
                </div>
                <div class="info-item">
                    <label>Date de fin</label>
                    <!-- <span><?php echo date('d/m/Y', strtotime($project['end_date'])); ?></span> -->
                </div>
                <div class="info-item">
                    <label>Budget</label>
                    <!-- <span><?php echo number_format($project['budget'], 2, ',', ' '); ?> €</span> -->
                </div>
            </div>

            <div class="progress-container">
                <label>Progression globale</label>
                <!-- <?php
                $progress = $project['total_tasks'] > 0 
                    ? ($project['completed_tasks'] / $project['total_tasks']) * 100 
                    : 0;
                ?> -->
                <div class="progress-bar">
                    <!-- <div class="progress-fill" style="width: <?php echo $progress; ?>%"></div> -->
                <!-- </div>
                <span><?php echo round($progress); ?>%</span>
            </div> -->
        </div>

        <div class="tasks-section">
            <div class="tasks-header">
                <h2>Tâches</h2>
                <!-- <button class="btn btn-primary" onclick="showAddTaskModal()"> -->
                <button class="btn btn-primary" onclick="location.href='form_ajout_tache.php'">
                    Ajouter une tâche
                </button>
            </div>

            <div class="task-list">
                <!-- <?php foreach ($tasks as $task): ?> -->
                    <div class="task-item">
                        <div class="task-info">
                            <!-- <h3 class="task-title"><?php echo htmlspecialchars($task['title']); ?></h3> -->
                            <!-- <div class="task-meta">
                                Assigné à: <?php echo htmlspecialchars($task['assignee_name'] ?? 'Non assigné'); ?> |
                                Échéance: <?php echo date('d/m/Y', strtotime($task['due_date'])); ?>
                            </div> -->
                        </div>
                        <!-- <span class="priority-badge priority-<?php echo $task['priority']; ?>">
                             <?php echo ucfirst($task['priority']); ?> -->
                        </span>
                        <!-- <span class="status-badge status-<?php echo $task['status']; ?>">
                            <?php echo ucfirst($task['status']); ?>
                        </span> -->
                    </div>
                <!-- <?php endforeach; ?> -->
            </div>
        </div>
    </div>

   
</body>
</html>
