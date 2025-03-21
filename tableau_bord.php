<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion de Projets</title>
    <link rel="stylesheet" href="../Asset/css/style dash 1.css">
    <script src="../Asset/js/dash_bord1.js"></script>
      
      

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Gestion Projets</h2>
        </div>
        <ul class="sidebar-menu">
            <li class="active">Tableau de bord</li>
            <li>Projets</li>
            <li>Tâches</li>
            <li>Équipes</li>
            <li>Rapports</li>
            <li>Paramètres</li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tableau de bord</h1>
            <button class="btn btn-primary" onclick="location.href='creer_projet.php'">
                Nouveau Projet
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projets Actifs</h3>
                </div>
                <div class="card-body">
                    <!-- <h2><?php echo count($projects); ?></h2> -->
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tâches en cours</h3>
                </div>
                <div class="card-body">
                    <h2>
                        <!-- <?php
                        $total_tasks = array_sum(array_column($projects, 'total_tasks'));
                        echo $total_tasks;
                        ?> -->
                    </h2>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tâches terminées</h3>
                </div>
                <div class="card-body">
                    <h2>
                        <!-- <?php
                        $completed_tasks = array_sum(array_column($projects, 'completed_tasks'));
                        echo $completed_tasks;
                        ?> -->
                    </h2>
                </div>
            </div>
        </div>

        <!-- Projects List -->
        <div class="project-list">
            <h2>Projets récents</h2>
            <!-- <?php foreach ($projects as $project): ?> -->
                <div class="project-item">
                    <div class="project-info">
                        <h3 class="project-title">
                            <!-- <?php echo htmlspecialchars($project['name']); ?> -->
                        </h3>
                        <div class="project-meta">
                            <!-- Début: <?php echo date('d/m/Y', strtotime($project['start_date'])); ?>
                            | Fin: <?php echo date('d/m/Y', strtotime($project['end_date'])); ?> -->
                        </div>
                    </div>
                    <div class="project-progress">
                        <!-- <?php
                        $progress = $project['total_tasks'] > 0 
                            ? ($project['completed_tasks'] / $project['total_tasks']) * 100 
                            : 0;
                        ?> -->
                        <div class="progress-bar">
                            <!-- <div class="progress-fill" style="width: <?php echo $progress; ?>%"></div> -->
                        </div>
                    </div>
                    <button class="btn btn-primary" 
                            onclick="location.href='projects/view.php?id='">
                        Voir détails
                    </button>
                </div>
            <!-- <?php endforeach; ?> -->
        </div>
    </div>
</div>



