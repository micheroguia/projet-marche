<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports et Statistiques</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <link rel="stylesheet" href="../Asset/css/style gest rapport.css">
<script src="../Asset/js/gest_rapport.js"></script>
</head>
<body>

    <div class="container">
        <?php include 'includes/sidebar.php'; ?>

        <main class="reports-container">
            <h1>Rapports et Statistiques</h1>

            <div class="date-range">
                <input type="date" id="start-date" onchange="updateReports()">
                <input type="date" id="end-date" onchange="updateReports()">
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Projets</h3>
                    <!-- <div class="stat-value"><?php echo $stats['projects']['total']; ?></div> -->
                    <div class="stat-details">
                         <div>Actifs: <!--<?php echo $stats['projects']['active']; ?></div> -->
                        <div>Complétés: <!--<?php echo $stats['projects']['completed']; ?></div>-->
                        <div>En retard: <!--<?php echo $stats['projects']['delayed']; ?></div>-->
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Tâches</h3>
                   <div class="stat-value">  <!-- <?php echo $stats['tasks']['total']; ?></div> -->
                    <div class="stat-details">
                        <div>Complétées: <!--  <?php echo $stats['tasks']['completed']; ?></div>-->
                        <div>En cours: <!--  <?php echo $stats['tasks']['in_progress']; ?></div>-->
                        <div>En retard: <!--  <?php echo $stats['tasks']['overdue']; ?></div>-->
                    </div>
                </div>

                <div class="stat-card">
                    <h3>Temps de Travail</h3>
                   <!-- <div class="stat-value"><?php echo $stats['time_tracking']['this_month']; ?></div>  -->
                    <div class="stat-details">
                        <div>Cette semaine:<!--<?php echo $stats['time_tracking']['this_week']; ?></div>-->
                        <div>Total:<!-- <?php echo $stats['time_tracking']['total_hours']; ?></div>-->
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h2>Tendance des Tâches</h2>
                    <select id="chart-type" onchange="updateChartType()">
                        <option value="line">Ligne</option>
                        <option value="bar">Barres</option>
                    </select>
                </div>
                <canvas id="tasksChart"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h2>Répartition du Temps par Projet</h2>
                </div>
                <canvas id="timeDistributionChart"></canvas>
            </div>
        </main>
    </div>

  
</body>
</html>
