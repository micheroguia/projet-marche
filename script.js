// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    // Sélection des éléments du DOM
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    const backToTop = document.getElementById('backToTop');
    const cookieConsent = document.getElementById('cookieConsent');
    const cookieAccept = document.getElementById('cookieAccept');
    const cookieReject = document.getElementById('cookieReject');
    
    // Gestion du menu mobile
    menuToggle.addEventListener('click', function() {
        navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        // Animation des barres du menu
        this.classList.toggle('active');
    });

    // Ajuster l'affichage du menu lors du redimensionnement
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            navLinks.style.display = 'flex';
        } else {
            navLinks.style.display = 'none';
        }
    });

    // Animation des boutons
    const buttons = document.querySelectorAll('.btn-primary, .btn-login, .btn-secondary');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) translateY(-2px)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) translateY(0)';
        });
    });

    // Animation des statistiques
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = value + (element.dataset.suffix || '');
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Observer pour les animations au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('stat-number')) {
                    const value = parseInt(entry.target.dataset.value);
                    animateValue(entry.target, 0, value, 2000);
                    observer.unobserve(entry.target);
                } else {
                    entry.target.classList.add('animate');
                    observer.unobserve(entry.target);
                }
            }
        });
    }, { threshold: 0.1 });

    // Observer les éléments pour l'animation
    document.querySelectorAll('.stat-number, .feature-card').forEach(el => {
        observer.observe(el);
    });

    // Gestion des témoignages
    const testimonials = [
        {
            content: "Une solution exceptionnelle qui a transformé notre gestion des marchés publics.",
            author: "Marie Dubois, Directrice des Achats"
        },
        {
            content: "Interface intuitive et fonctionnalités complètes. Exactement ce dont nous avions besoin.",
            author: "Jean Martin, Responsable Marchés Publics"
        },
        {
            content: "Le support client est remarquable. Une équipe vraiment à l'écoute.",
            author: "Sophie Laurent, Chef de Projet"
        }
    ];

    let currentTestimonial = 0;
    const testimonialContainer = document.querySelector('.testimonial-container');

    // Fonction pour afficher un témoignage
    function showTestimonial(index) {
        const testimonial = testimonials[index];
        testimonialContainer.innerHTML = `
            <div class="testimonial active">
                <p class="testimonial-content">"${testimonial.content}"</p>
                <p class="testimonial-author">${testimonial.author}</p>
            </div>
        `;
    }

    // Navigation des témoignages
    document.querySelector('.prev-testimonial').addEventListener('click', () => {
        currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
        showTestimonial(currentTestimonial);
    });

    document.querySelector('.next-testimonial').addEventListener('click', () => {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    });

    // Afficher le premier témoignage
    showTestimonial(0);

    // Rotation automatique des témoignages
    setInterval(() => {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        showTestimonial(currentTestimonial);
    }, 5000);

    // Gestion du bouton retour en haut
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Gestion du consentement des cookies
    function showCookieConsent() {
        if (!localStorage.getItem('cookieConsent')) {
            cookieConsent.classList.add('show');
        }
    }

    cookieAccept.addEventListener('click', () => {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieConsent.classList.remove('show');
    });

    cookieReject.addEventListener('click', () => {
        localStorage.setItem('cookieConsent', 'rejected');
        cookieConsent.classList.remove('show');
    });

    // Afficher la bannière de cookies après un délai
    setTimeout(showCookieConsent, 1000);

    // Gestion du formulaire newsletter
    const newsletterForm = document.querySelector('.newsletter-form');
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        
        if (email) {
            // Simulation d'envoi à l'API
            console.log('Inscription newsletter:', email);
            alert('Merci de votre inscription à la newsletter !');
            this.reset();
        }
    });

    // Animation des liens de navigation
    const navItems = document.querySelectorAll('.nav-links a');
    navItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});