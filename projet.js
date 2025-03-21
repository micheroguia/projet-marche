

// Fonctions JavaScript pour la gestion des modals et des actions
function showNewProjectModal() {
    document.getElementById('newProjectModal').style.display = 'block';
}

function hideNewProjectModal() {
    document.getElementById('newProjectModal').style.display = 'none';
}

function showProjectActions(projectId) {
    const menu = document.getElementById(`actions-${projectId}`);
    document.querySelectorAll('.actions-menu').forEach(m => {
        if (m !== menu) m.classList.remove('active');
    });
    menu.classList.toggle('active');
}

function deleteProject(projectId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
        // Ajoutez ici la logique de suppression
        window.location.href = `projects.php?action=delete&id=${projectId}`;
    }
}

// Fermer les menus d'actions quand on clique ailleurs
document.addEventListener('click', function(event) {
    if (!event.target.closest('.project-actions')) {
        document.querySelectorAll('.actions-menu').forEach(menu => {
            menu.classList.remove('active');
        });
    }
});

// Validation du formulaire
document.getElementById('newProjectForm').addEventListener('submit', function(e) {
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);

    if (endDate < startDate) {
        e.preventDefault();
        alert('La date de fin doit être postérieure à la date de début');
    }
});
