<?php 
// Inclure l'en-tête et la connexion à la base de données
include ('header.php');

// --- 1. RÉCUPÉRER TOUTES LES DONNÉES DU TABLEAU DE BORD ---
// Plus efficace que de faire une requête séparée pour chaque carte.

// --- Données pour les cartes ---
$total_books_query = mysqli_query($con, "SELECT COUNT(book_id) as total FROM book");
$total_books = mysqli_fetch_assoc($total_books_query)['total'];

$total_members_query = mysqli_query($con, "SELECT COUNT(user_id) as total FROM user");
$total_members = mysqli_fetch_assoc($total_members_query)['total'];

$books_on_loan_query = mysqli_query($con, "SELECT COUNT(borrow_book_id) as total FROM borrow_book WHERE borrowed_status = 'borrowed'");
$books_on_loan = mysqli_fetch_assoc($books_on_loan_query)['total'];

$overdue_books_query = mysqli_query($con, "SELECT COUNT(borrow_book_id) as total FROM borrow_book WHERE borrowed_status = 'borrowed' AND due_date < NOW()");
$overdue_books = mysqli_fetch_assoc($overdue_books_query)['total'];

$lost_books_query = mysqli_query($con, "SELECT COUNT(book_id) as total FROM book WHERE status = 'Perdu'");
$lost_books = mysqli_fetch_assoc($lost_books_query)['total'];

// AJOUTER CETTE NOUVELLE REQUÊTE POUR LA 6ÈME CARTE
$total_fines_query = mysqli_query($con, "SELECT SUM(book_penalty) as total FROM return_book");
$total_fines = mysqli_fetch_assoc($total_fines_query)['total'];
// Formater le nombre pour afficher 2 décimales, gérer le cas où il pourrait être NULL (pas encore de pénalités)
$total_fines_formatted = number_format((float)$total_fines, 2);


// --- Données pour les graphiques ---
// a) Livres par catégorie (Bar Chart)
$categories_query = mysqli_query($con, "SELECT category, COUNT(book_id) as count FROM book GROUP BY category ORDER BY count DESC LIMIT 10");
$category_labels = [];
$category_data = [];
while ($row = mysqli_fetch_assoc($categories_query)) {
    $category_labels[] = $row['category'];
    $category_data[] = $row['count'];
}
$category_labels_json = json_encode($category_labels);
$category_data_json = json_encode($category_data);

// b) Types de membres (Doughnut Chart)
$members_type_query = mysqli_query($con, "SELECT type, COUNT(user_id) as count FROM user GROUP BY type");
$member_type_labels = [];
$member_type_data = [];
while ($row = mysqli_fetch_assoc($members_type_query)) {
    $member_type_labels[] = $row['type'];
    $member_type_data[] = $row['count'];
}
$member_type_labels_json = json_encode($member_type_labels);
$member_type_data_json = json_encode($member_type_data);
?>

<!-- contenu de la page -->
</br></br>
<div class="right_col" role="main" style="background-color: #bdeff3ff;">
    
    <!-- tuiles du haut -->
    <div class="row tile_count">
        
        <!-- Carte Total Livres -->
        <div class="animated flipInY col-md-4 col-sm-6 col-xs-12 tile_stats_count" 
             style="background:#fff; border:1px solid #e0e0e0; border-left: 5px solid #3498DB; border-radius: 5px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <div class="left" style="border:none;"></div>
            <div class="right">
                <span class="count_top" style="font-weight:600;"><i class="fa fa-book" style="color:#3498DB;"></i> Total Livres</span>
                <div class="count" style="color:#3498DB;"><?php echo $total_books; ?></div>
                <span class="count_bottom">dans la collection</span>
            </div>
        </div>
        
        <!-- Carte Total Membres -->
        <div class="animated flipInY col-md-4 col-sm-6 col-xs-12 tile_stats_count"
             style="background:#fff; border:1px solid #e0e0e0; border-left: 5px solid #2ECC71; border-radius: 5px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <div class="left" style="border:none;"></div>
            <div class="right">
                <span class="count_top" style="font-weight:600;"><i class="fa fa-users" style="color:#2ECC71;"></i> Total Membres</span>
                <div class="count" style="color:#2ECC71;"><?php echo $total_members; ?></div>
                <span class="count_bottom">étudiants & enseignants</span>
            </div>
        </div>

        <!-- Carte Livres Empruntés -->
        <div class="animated flipInY col-md-4 col-sm-6 col-xs-12 tile_stats_count"
             style="background:#fff; border:1px solid #e0e0e0; border-left: 5px solid #9B59B6; border-radius: 5px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <div class="left" style="border:none;"></div>
            <div class="right">
                <span class="count_top" style="font-weight:600;"><i class="fa fa-arrow-circle-o-right" style="color:#9B59B6;"></i> Livres Empruntés</span>
                <div class="count" style="color:#9B59B6;"><?php echo $books_on_loan; ?></div>
                <span class="count_bottom">actuellement empruntés</span>
            </div>
        </div>

        <!-- Carte Livres en Retard -->
        <div class="animated flipInY col-md-4 col-sm-6 col-xs-12 tile_stats_count"
             style="background:#fff; border:1px solid #e0e0e0; border-left: 5px solid #F39C12; border-radius: 5px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <div class="left" style="border:none;"></div>
            <div class="right">
                <span class="count_top" style="font-weight:600;"><i class="fa fa-exclamation-triangle" style="color:#F39C12;"></i> Livres en Retard</span>
                <div class="count" style="color:#F39C12;"><?php echo $overdue_books; ?></div>
                <span class="count_bottom">à retourner</span>
            </div>
        </div>

        <!-- Carte Livres Perdus -->
        <div class="animated flipInY col-md-4 col-sm-6 col-xs-12 tile_stats_count"
             style="background:#fff; border:1px solid #e0e0e0; border-left: 5px solid #E74C3C; border-radius: 5px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <div class="left" style="border:none;"></div>
            <div class="right">
                <span class="count_top" style="font-weight:600;"><i class="fa fa-times-circle" style="color:#E74C3C;"></i> Livres Perdus</span>
                <div class="count" style="color:#E74C3C;"><?php echo $lost_books; ?></div>
                <span class="count_bottom">marqués comme perdus</span>
            </div>
        </div>

        
    <!-- *** NOUVEAU : Total des Amendes Collectées *** -->
    <div class="animated flipInY col-md-4 col-sm-6 col-xs-12 tile_stats_count"
         style="background:#fff; border:1px solid #e0e0e0; border-left: 5px solid #34495E; border-radius: 5px; padding: 15px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <div class="left" style="border:none;"></div>
        <div class="right">
            <span class="count_top" style="font-weight:600;"><i class="fa fa-money" style="color:#34495E;"></i> Amendes Totales</span>
            <div class="count" style="color:#34495E;">€<?php echo $total_fines_formatted; ?></div>
            <span class="count_bottom">collectées sur les pénalités</span>
        </div>
    </div>


    </div>
    <!-- /tuiles du haut -->

    <div class="clearfix"></div>

    <div class="row">
        <!-- Graphique en Barres : Livres par Catégorie -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bar-chart"></i> Livres par Catégorie <small>(Top 10)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <canvas id="booksByCategoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique Doughnut : Types de Membres -->
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-pie-chart"></i> Répartition des Membres</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- AJOUTER CE DIV WRAPPER AVEC UNE HAUTEUR MAX -->
            <div style="max-height: 280px; margin: 0 auto;">
                <canvas id="memberTypesChart"></canvas>
            </div>
        </div>
    </div>
</div>
    </div>
    
</div>
<!-- /contenu de la page -->


<!-- === JAVASCRIPT POUR LES GRAPHIQUES === -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const COLORS = {
        blue: 'rgba(52, 152, 219, 0.7)',
        green: 'rgba(46, 204, 113, 0.7)',
        purple: 'rgba(155, 89, 182, 0.7)',
        orange: 'rgba(243, 156, 18, 0.7)',
        red: 'rgba(231, 76, 60, 0.7)',
        darkBlue: 'rgba(44, 62, 80, 0.7)'
    };

    // Graphique en Barres : Livres par Catégorie
    const categoryCtx = document.getElementById('booksByCategoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: <?php echo $category_labels_json; ?>,
            datasets: [{
                label: '# de Livres', // Traduction du label
                data: <?php echo $category_data_json; ?>,
                backgroundColor: [COLORS.blue, COLORS.green, COLORS.purple, COLORS.orange, COLORS.red, COLORS.darkBlue],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            scales: { 
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 1 } 
                } 
            },
            plugins: { 
                legend: { display: false } 
            }
        }
    });

    // Graphique Donut : Répartition des Membres
    const memberCtx = document.getElementById('memberTypesChart').getContext('2d');
    new Chart(memberCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo $member_type_labels_json; ?>,
            datasets: [{
                label: 'Types de Membres', // Traduction du label
                data: <?php echo $member_type_data_json; ?>,
                backgroundColor: [COLORS.green, COLORS.blue, COLORS.purple],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, 
            plugins: {
                legend: { 
                    position: 'top',
                    labels: {
                        generateLabels: function(chart) {
                            // Traduction dynamique des labels si nécessaire
                            const dataLabels = chart.data.labels.map(label => label);
                            return chart.data.labels.map((label, index) => ({
                                text: label, // texte déjà traduit via PHP si besoin
                                fillStyle: chart.data.datasets[0].backgroundColor[index],
                                hidden: false,
                                index: index
                            }));
                        }
                    }
                },
                title: { 
                    display: true, 
                    text: 'Répartition des Membres de la Bibliothèque' // Traduction du titre
                }
            }
        }
    });
});
</script>

<?php include ('footer.php'); ?>
