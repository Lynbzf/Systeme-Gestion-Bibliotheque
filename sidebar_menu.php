<!-- navigation de la barre latérale -->
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="home.php" class="site_title">
                <i class="fa fa-university"></i> 
                <span>Bibliothèque Pro</span>
            </a>
        </div>
        <div class="clearfix"></div>

        <!-- informations rapides du profil -->
        <?php
            include_once('include/dbcon.php'); // Utilisation de include_once pour éviter les redéclarations
            
            $user_query = mysqli_query($con, "SELECT * FROM admin WHERE admin_id='$id_session'") or die(mysqli_error($con));
            $row = mysqli_fetch_array($user_query);
            // Normalisation du type d'administrateur en minuscules pour une vérification robuste
            $admin_type = strtolower($row['admin_type']); 
        ?>
        <!-- section profil restaurée pour corriger la mise en page -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <?php if(!empty($row['admin_image'])): ?>
                    <img src="upload/<?php echo $row['admin_image']; ?>" alt="..." class="img-circle profile_img">
                <?php else: ?>
                    <img src="images/user.png" alt="..." class="img-circle profile_img">
                <?php endif; ?>
            </div>
            <div class="profile_info">
                <span>Bienvenue,</span>
                <!-- Utilisation de htmlspecialchars pour prévenir les attaques XSS -->
                <h2><?php echo htmlspecialchars($row['firstname']); ?></h2>
            </div>
        </div>
        <!-- /informations rapides du profil -->

        <br />

        <!-- menu de la barre latérale -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <!-- Le style en ligne causant un grand espace a été SUPPRIMÉ -->
                <h3>Informations des fichiers</h3>
                <div class="separator"></div>
                <ul class="nav side-menu">
                    <li><a href="home.php"><i class="fa fa-home"></i> Accueil</a></li>
                    <li><a href="member.php"><i class="fa fa-users"></i> Membres</a></li>
                    
                    <?php if($admin_type == 'admin') { ?>
                    <li><a href="admin.php"><i class="fa fa-user"></i> Administrateur / Bibliothécaire</a></li>
                    <?php } ?>
                    
                    <li><a href="book.php"><i class="fa fa-book"></i> Livres</a></li>

                    <?php if($admin_type == 'librarian') { ?>
                    <li><a href="librarian.php"><i class="fa fa-user"></i> Bibliothécaire</a></li>
                    <?php } ?>

                    <?php if($admin_type == 'admin') { ?>
                    <li><a href="user_log_in.php"><i class="fa fa-history"></i> Historique des membres</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Informations des transactions</h3>
                <div class="separator"></div>
                <ul class="nav side-menu">
                    <li><a href="borrow.php"><i class="fa fa-edit"></i> Emprunt / Retour</a></li>
                    <li><a href="report.php"><i class="fa fa-file"></i> Rapports</a></li>
                    <li><a href="individual_report.php"><i class="fa fa-file"></i> Rapport individuel</a></li>
                    <li><a href="borrowed_book.php"><i class="fa fa-book"></i> Livres empruntés</a></li>
                    <li><a href="returned_book.php"><i class="fa fa-book"></i> Livres retournés</a></li>

                    <?php if($admin_type == 'admin') { ?>
                    <li><a href="settings.php"><i class="fa fa-cog"></i> Paramètres</a></li>
                    <?php } ?>

                    
                </ul>
            </div>
        </div>
        <!-- /menu de la barre latérale -->
    </div>
</div>
<!-- fin de la navigation de la barre latérale -->
