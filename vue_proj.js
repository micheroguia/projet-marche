
function showAddTaskModal() {
    // Implémenter la modal d'ajout de tâche
    alert('Fonctionnalité en cours de développement');
}

// Mise à jour automatique du statut des tâches
document.addEventListener('DOMContentLoaded', function() {
    const taskItems = document.querySelectorAll('.task-item');
    
    taskItems.forEach(item => {
        item.addEventListener('click', function() {
            // Implémenter la vue détaillée de la tâche
            console.log('Tâche sélectionnée:', this.querySelector('.task-title').textContent);
        });
    });
});
