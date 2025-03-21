

// Fermer automatiquement les alertes après 5 secondes
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 5000);
    });
});

// Afficher la modal pour ajouter un membre
function showAddMemberModal(teamId) {
    document.getElementById('team_id').value = teamId;
    const modal = document.getElementById('addMemberModal');
    modal.style.display = 'flex';
}

// Cacher la modal pour ajouter un membre
function hideAddMemberModal() {
    const modal = document.getElementById('addMemberModal');
    modal.style.display = 'none';
}

// Supprimer un membre
function removeMember(teamId, userId) {
    if (confirm('Êtes-vous sûr de vouloir retirer ce membre de l\'équipe ?')) {
        window.location.href = `teams.php?action=remove_member&team_id=${teamId}&user_id=${userId}`;
    }
}

// Fermer les modals si on clique en dehors
window.addEventListener('click', function(event) {
    const addMemberModal = document.getElementById('addMemberModal');
    if (event.target === addMemberModal) {
        hideAddMemberModal();
    }
});
