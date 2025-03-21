
        // Validation du formulaire de changement de mot de passe
        document.querySelector('form[action="change_password"]').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas');
            }
        });
    