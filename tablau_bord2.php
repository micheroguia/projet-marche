<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion de Projets</title>
    <link rel="stylesheet" href="../Asset/css/style daschbord.css">
    <script src="../Asset/js/dash_bord.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Gestion de Projets</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php">Tableau de bord</a></li>
                <li><a href="projects.php">Projets</a></li>
                <li><a href="tasks.php">Tâches</a></li>
                <li><a href="teams.php">Équipes</a></li>
                <li><a href="reports.php">Rapports</a></li>
                <li><a href="settings.php">Paramètres</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="dashboard-header">
                <h1>Tableau de bord</h1>
                <button class="btn btn-primary" onclick="location.href='projects.php?action=new'">
                    Nouveau Projet
                </button>
            </div>

            <div class="stats-container">
                <!-- <?php
                // Statistiques globales
                $stats = [
                    'total_projects' => count($projects),
                    'active_projects' => array_reduce($projects, function($carry, $project) {
                        return $carry + ($project['status'] === 'active' ? 1 : 0);
                    }, 0),
                    'completed_tasks' => array_reduce($projects, function($carry, $project) {
                        return $carry + $project['completed_tasks'];
                    }, 0),
                    'total_tasks' => array_reduce($projects, function($carry, $project) {
                        return $carry + $project['total_tasks'];
                    }, 0)
                ];
                ?> -->
                <div class="stat-card">
                    <h3>Projets Totaux</h3>
                    <p class="stat-number"><?php echo $stats['total_projects']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Projets Actifs</h3>
                    <p class="stat-number"><?php echo $stats['active_projects']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Tâches Complétées</h3>
                    <p class="stat-number"><?php echo $stats['completed_tasks']; ?>/<?php echo $stats['total_tasks']; ?></p>
                </div>
            </div>

            <h2>Projets Récents</h2>
            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                        <p><?php echo htmlspecialchars(substr($project['description'], 0, 100)) . '...'; ?></p>
                        
                        <?php
                        $completion = $project['total_tasks'] > 0 
                            ? ($project['completed_tasks'] / $project['total_tasks']) * 100 
                            : 0;
                        ?>
                        <div class="progress-bar">
                            <!-- <div class="progress-bar-fill" style="width: <?php echo $completion; ?>%"></div> -->
                        </div>
                        
                        <div class="project-meta">
                            <span class="project-status status-<?php echo $project['status']; ?>">
                                <?php echo ucfirst($project['status']); ?>
                            </span>
                            <span class="project-tasks">
                                <!-- <?php echo $project['completed_tasks']; ?>/<?php echo $project['total_tasks']; ?> tâches -->
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    
</body>
</html>
