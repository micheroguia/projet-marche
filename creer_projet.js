
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createProjectForm');
    
    form.addEventListener('submit', function(e) {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);

        if (endDate < startDate) {
            e.preventDefault();
            alert('La date de fin doit être postérieure à la date de début');
            return;
        }

        // Validation du budget
        const budget = document.getElementById('budget').value;
        if (budget && budget < 0) {
            e.preventDefault();
            alert('Le budget ne peut pas être négatif');
            return;
        }
    });

    // Définir la date minimum pour le début du projet à aujourd'hui
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start_date').min = today;
    
    // Mettre à jour la date minimum de fin en fonction de la date de début
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
    });
});
