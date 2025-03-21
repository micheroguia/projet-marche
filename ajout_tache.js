

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addTaskForm');
    const dueDateInput = document.getElementById('due_date');
    
    // Définir la date minimum à aujourd'hui
    const today = new Date().toISOString().split('T')[0];
    dueDateInput.min = today;
    
    // Définir la date maximum à la date de fin du projet
    // const projectEndDate = '<?php echo $project['end_date']; ?>';
    dueDateInput.max = projectEndDate;

    form.addEventListener('submit', function(e) {
        const dueDate = new Date(dueDateInput.value);
        const projectEnd = new Date(projectEndDate);

        if (dueDate > projectEnd) {
            e.preventDefault();
            alert('La date d\'échéance ne peut pas être postérieure à la date de fin du projet');
            return;
        }

        const estimatedHours = document.getElementById('estimated_hours').value;
        if (estimatedHours && estimatedHours < 0) {
            e.preventDefault();
            alert('Les heures estimées ne peuvent pas être négatives');
            return;
        }
    });
});
