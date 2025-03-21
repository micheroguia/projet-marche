
// Configuration des graphiques
// const taskTrendData = <?php echo json_encode($task_trend); ?>;

const tasksChart = new Chart(document.getElementById('tasksChart'), {
    type: 'line',
    data: {
        labels: taskTrendData.map(item => item.date),
        datasets: [{
            label: 'Nombre de tâches',
            data: taskTrendData.map(item => item.count),
            borderColor: '#0052CC',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Évolution des tâches sur 30 jours'
            }
        }
    }
});

function updateChartType() {
    const type = document.getElementById('chart-type').value;
    tasksChart.config.type = type;
    tasksChart.update();
}

function updateReports() {
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    
    // Mettre à jour les données via AJAX
    fetch(`api/reports.php?start=${startDate}&end=${endDate}`)
        .then(response => response.json())
        .then(data => {
            // Mettre à jour les statistiques et les graphiques
            updateStats(data.stats);
            updateCharts(data.charts);
        });
}

function updateStats(stats) {
    // Mettre à jour les valeurs des cartes de statistiques
    Object.keys(stats).forEach(key => {
        const elements = document.querySelectorAll(`[data-stat="${key}"]`);
        elements.forEach(element => {
            element.textContent = stats[key];
        });
    });
}

function updateCharts(chartData) {
    // Mettre à jour les données des graphiques
    tasksChart.data.labels = chartData.tasks.labels;
    tasksChart.data.datasets[0].data = chartData.tasks.data;
    tasksChart.update();
}
