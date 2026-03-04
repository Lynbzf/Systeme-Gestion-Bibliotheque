<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <!-- Ceci est le menu standard à bascule (icône hamburger) pour l’affichage mobile -->
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <?php
                   
                    if (isset($row)) {
                ?>
                <li class="nav navbar-nav navbar-left"> <h4 style="font-weight: bold;padding-left: 20px;"><?php echo $row['admin_type']; ?> Tableau de Bord</h4> </li>

                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php echo $row['admin_type']; ?>
                        <?php if(!empty($row['admin_image'])): ?>
                            <img src="upload/<?php echo $row['admin_image']; ?>" alt="">
                        <?php else: ?>
                            <img src="images/user.png" alt="">
                        <?php endif; ?>
                        
                        <!-- On utilise htmlspecialchars pour emêpecher des attaques XSS -->
                        <?php echo htmlspecialchars($row['firstname']); ?>
                        <span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Déconnexion</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->