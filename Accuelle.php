<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Métadonnées de base pour le document -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACADEMIQUE CORPORATION SARL - Gestion des Marchés Publics</title>
    <!-- Lien vers la feuille de style CSS -->
    <link rel="stylesheet" href="../Asset/css/style.css">
    <script src="../Asset/js/script.js"></script> 
    
</head>

<body>
    <!-- En-tête de la page contenant la navigation -->
    <?php include "menunavigation.php";?>

    <!-- Section héro avec animation -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="animate-title">Gérez vos marchés publics efficacement</h1>
                <p class="animate-text">Une solution complète pour la gestion, le suivi et l'optimisation de vos marchés
                    publics</p>
                <div class="hero-buttons">
                    <button class="btn-primary">Commencer maintenant</button>
                    <button class="btn-secondary">Voir la démo</button>
                </div>
                <!-- Statistiques -->
                <div class="stats-container">
                    <div class="stat-item">
                        <span class="stat-number" data-value="500">0</span>
                        <span class="stat-label">Clients satisfaits</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-value="1000">0</span>
                        <span class="stat-label">Projets gérés</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-value="95">0</span>
                        <span class="stat-label">Taux de réussite</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section caractéristiques avec animations au scroll -->
    <section class="features">
        <div class="container">
            <h2>Fonctionnalités principales</h2>
            <div class="features-grid">
                <!-- Carte de fonctionnalité : Suivi des marchés -->
                <div class="feature-card" data-aos="fade-up">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="16" height="16" x="4" y="4" rx="2" />
                        <path d="m4 10h16" />
                        <path d="M10 4v16" />
                    </svg>
                    <h3>Suivi des marchés</h3>
                    <p>Gérez l'ensemble du cycle de vie de vos marchés publics en un seul endroit.</p>
                    <ul class="feature-list">
                        <li>Tableau de bord en temps réel</li>
                        <li>Alertes automatiques</li>
                        <li>Suivi des échéances</li>
                    </ul>
                </div>
                <!-- Carte de fonctionnalité : Gestion des fournisseurs -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <h3>Gestion des fournisseurs</h3>
                    <p>Centralisez vos relations avec les fournisseurs et optimisez vos collaborations.</p>
                    <ul class="feature-list">
                        <li>Base de données fournisseurs</li>
                        <li>Évaluation des performances</li>
                        <li>Communication intégrée</li>
                    </ul>
                </div>
                <!-- Carte de fonctionnalité : Tableaux de bord -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M7 7v10" />
                        <path d="M11 7v10" />
                        <path d="M15 7v10" />
                    </svg>
                    <h3>Tableaux de bord</h3>
                    <p>Visualisez vos KPIs et prenez des décisions éclairées grâce à nos analyses détaillées.</p>
                    <ul class="feature-list">
                        <li>Rapports personnalisables</li>
                        <li>Analyses prédictives</li>
                        <li>Export de données</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section témoignages avec slider -->
    <section class="testimonials">
        <div class="container">
            <h2>Ils nous font confiance</h2>
            <div class="testimonials-slider">
                <div class="testimonial-container">
                    <!-- Les témoignages seront injectés ici par JavaScript -->
                </div>
                <div class="slider-controls">
                    <button class="prev-testimonial">&lt;</button>
                    <button class="next-testimonial">&gt;</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Section appel à l'action -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Prêt à optimiser votre gestion des marchés ?</h2>
                <p>Rejoignez les entreprises qui font confiance à ACADEMIQUE CORPORATION SARL</p>
                <button class="btn-primary">Demander une démo</button>
            </div>
        </div>
    </section>

    <!-- Pied de page amélioré -->
    <?php include "footer.php";?>
    

</body>

</html>