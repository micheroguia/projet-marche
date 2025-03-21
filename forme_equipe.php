<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Équipes</title>
    <link rel="stylesheet" href="../Asset/css/style equipe.css">
    <script src="../Asset/js/equipe.js"></script> 

</head>
<body>

<?php if ($successMessage): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($successMessage); ?>
    </div>
    <?php endif; ?>
    
    <?php if ($errorMessage): ?>
    <div class="alert alert-error">
        <?php echo htmlspecialchars($errorMessage); ?>
    </div>
    <?php endif; ?>

    <div class="container">
        <button class="toggle-sidebar-btn" onclick="toggleSidebar()">&#9776;</button>
        <div class="sidebar" id="sidebar">
            <a href="#">Dashboard</a>
            <a href="#">Projets</a>
            <a href="#">Utilisateurs</a>
            <a href="#">Paramètres</a>
        </div>

        <main class="teams-container">
            <div class="teams-header">
                <h1>Équipes</h1>
                <div class="header-actions">
                    <input type="text" class="search-bar" placeholder="Rechercher une équipe...">
                    <button class="btn-primary" onclick="showNewTeamModal()">Nouvelle Équipe</button>
                </div>
            </div>

            <div class="teams-grid">
                <?php if (empty($teams)): ?>
                    <div class="empty-state">
                        <p>Aucune équipe n'a été créée pour le moment.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($teams as $team): ?>
                        <div class="team-card">
                            <div class="team-header">
                                <h3><?php echo htmlspecialchars($team['NOM_TEAM']); ?></h3>
                                <div class="team-actions">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>

                            <p><?php echo htmlspecialchars($team['DESCRIPTION_TEAM']); ?></p>
                            
                            <?php if ($team['LEADER']): ?>
                            <div class="team-leader">
                                <strong>Leader:</strong> <?php echo htmlspecialchars($team['LEADER']); ?>
                            </div>
                            <?php endif; ?>

                            <div class="team-stats">
                                <div class="stat-item">
                                    <i class="fas fa-users"></i>
                                    <?php echo $team['member_count']; ?> membres
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-project-diagram"></i>
                                    <?php echo $team['project_count']; ?> projets
                                </div>
                            </div>

                            <div class="member-list-header">
                                <h4>Membres</h4>
                                <button class="add-member-btn" onclick="showAddMemberModal(<?php echo $team['ID_TEAM']; ?>)">+</button>
                            </div>

                            <div class="member-list">
                                <?php 
                                $teamMembers = getTeamMembers($team['ID_TEAM']);
                                foreach ($teamMembers as $member): 
                                ?>
                                <div class="member-item">
                                    <div class="member-avatar">
                                        <?php echo substr($member['NAME_USER'], 0, 1); ?>
                                    </div>
                                    <div class="member-info">
                                        <div><?php echo htmlspecialchars($member['NAME_USER']); ?></div>
                                        <div class="member-role"><?php echo htmlspecialchars($member['ROLE']); ?></div>
                                    </div>
                                    <div class="member-actions">
                                        <button class="remove-member-btn" onclick="removeMember(<?php echo $team['ID_TEAM']; ?>, <?php echo $member['ID_USER']; ?>)">×</button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                
                                <?php if (empty($teamMembers)): ?>
                                <div class="empty-members">
                                    <p>Aucun membre dans cette équipe</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Modal pour nouvelle équipe -->
    <div id="newTeamModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="hideNewTeamModal()">&times;</span>
            <h2>Nouvelle Équipe</h2>
            <form id="newTeamForm" method="POST" action="equipe.php">
                <div class="form-group">
                    <label for="name">Nom de l'équipe</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="leader">Leader de l'équipe</label>
                    <input type="text" id="leader" name="leader" class="form-control">
                </div>

                <div class="form-group">
                    <label>Membres</label>
                    <div class="member-selection">
                        <?php foreach ($usersByStatus as $status => $statusUsers): ?>
                        <div class="user-status"><?php echo htmlspecialchars($status); ?></div>
                        <?php foreach ($statusUsers as $user): ?>
                        <div class="member-option">
                            <input type="checkbox" name="members[]" value="<?php echo $user['ID_USER']; ?>" id="user_<?php echo $user['ID_USER']; ?>">
                            <label for="user_<?php echo $user['ID_USER']; ?>">
                                <?php echo htmlspecialchars($user['NAME_USER']); ?>
                                (<?php echo htmlspecialchars($user['EMAIL']); ?>)
                                <span class="user-role"><?php echo htmlspecialchars($user['ROLE']); ?></span>
                            </label>
                        </div>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Créer l'équipe</button>
            </form>
        </div>
    </div>
    
    <!-- Modal pour ajouter un membre -->
    <div id="addMemberModal" class="member-modal">
        <div class="member-modal-content">
            <span class="close-modal" onclick="hideAddMemberModal()">&times;</span>
            <h2>Ajouter un membre</h2>
            <form id="addMemberForm" method="POST" action="">
                <input type="hidden" id="team_id" name="team_id" value="">
                
                <?php foreach ($usersByStatus as $status => $statusUsers): ?>
                <div class="status-group">
                    <div class="status-title"><?php echo htmlspecialchars($status); ?></div>
                    <?php foreach ($statusUsers as $user): ?>
                    <div class="member-option">
                        <input type="radio" name="user_id" value="<?php echo $user['ID_USER']; ?>" id="add_user_<?php echo $user['ID_USER']; ?>">
                        <label for="add_user_<?php echo $user['ID_USER']; ?>">
                            <?php echo htmlspecialchars($user['NAME_USER']); ?>
                            (<?php echo htmlspecialchars($user['EMAIL']); ?>)
                            <span class="user-role"><?php echo htmlspecialchars($user['ROLE']); ?></span>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
                
                <button type="submit" class="btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>
