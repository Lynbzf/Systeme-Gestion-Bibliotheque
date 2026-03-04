<?php
// Inclure les fichiers nécessaires en premier
include ('include/dbcon.php');


// Vérifier si le formulaire a été soumis avec la méthode POST et si le bouton « submit » a été cliqué
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    // Vérifier si une image a été téléchargée
    if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        
        $file = $_FILES['image']['tmp_name'];
        $image = $_FILES["image"]["name"];
        $size = $_FILES["image"]["size"];
        
        // Vérifier la taille du fichier
        if ($size > 10000000) { // 10 Mo
            die("Erreur: Taille du fichier trop grande");
        }

        // Déplacer le fichier téléchargé
        $upload_path = "upload/" . basename($image);
        if (move_uploaded_file($file, $upload_path)) {
            $book_image = $image;

            // Récupérer toutes les données envoyées via le formulaire POST
            $book_title = $_POST['book_title'];
            $category = $_POST['category'];
            $author = $_POST['author'];
            $author_2 = $_POST['author_2'];
            $author_3 = $_POST['author_3'];
            $author_4 = $_POST['author_4'];
            $author_5 = $_POST['author_5'];
            $book_pub = $_POST['book_pub'];
            $publisher_name = $_POST['publisher_name'];
            $isbn = $_POST['isbn'];
            $copyright_year = $_POST['copyright_year'];
            $status = $_POST['status'];
            $n = (int)$_POST['book_copies']; // 

            // Boucle pour insérer le nombre de copies spécifié
            for ($i = 1; $i <= $n; $i++) {
                // --- Générer un nouveau code-barres ---
                $query = mysqli_query($con, "SELECT mid_barcode FROM `barcode` ORDER BY mid_barcode DESC LIMIT 1") or die(mysqli_error($con));
                
                $mid_barcode = 0; // Valeur par défaut si la table est vide
                if ($fetch = mysqli_fetch_array($query)) {
                    $mid_barcode = $fetch['mid_barcode'];
                }

                $new_barcode_mid = $mid_barcode + 1;
                $pre = "KIT";
                $suf = "VNS";
                $gen = $pre . $new_barcode_mid . $suf;

                $remark = ($status == 'Lost') ? 'Indisponible' : 'Disponible';

                // --- Utiliser des requêtes préparées pour la sécurité ---
                $stmt_book = mysqli_prepare($con, "INSERT INTO book (book_title, category, author, author_2, author_3, author_4, author_5, book_pub, publisher_name, isbn, copyright_year, status, book_barcode, book_image, date_added, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
                mysqli_stmt_bind_param($stmt_book, "sssssssssssssss", $book_title, $category, $author, $author_2, $author_3, $author_4, $author_5, $book_pub, $publisher_name, $isbn, $copyright_year, $status, $gen, $book_image, $remark);
                mysqli_stmt_execute($stmt_book) or die(mysqli_error($con));
                
                $stmt_barcode = mysqli_prepare($con, "INSERT INTO barcode (pre_barcode, mid_barcode, suf_barcode) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt_barcode, "sis", $pre, $new_barcode_mid, $suf);
                mysqli_stmt_execute($stmt_barcode) or die(mysqli_error($con));
            }

            // Redirection après un traitement réussi
            header('location: view_all_barcode.php?loop=' . $n);
            exit(); // Toujours quitter après une redirection avec header

        } else {
            echo "<div class='alert alert-danger'>Erreur: Impossible de déplacer le fichier téléchargé. Vérifier les permissions.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Erreur: Pas d'image téléchargée ou il y a une erreur de téléchargement.</div>";
    }
}
include ('header.php');
?>

<!-- === SECTION FORMULAIRE HTML === -->
<div class="page-title">
    <div class="title_left">
        <h3>
            <small>Acceuil / Livres /</small> Ajouter Livre
        </h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-plus"></i> Ajouter livre</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <!-- le contenu commence ici -->

                <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    <!-- Le champ caché inutile a été SUPPRIMÉ -->
                    
                     <div class="form-group">
                        <label class="control-label col-md-4" for="book_title">Titre <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="book_title" id="book_title" required="required" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="author">Auteur 1 <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="author" id="author" required="required" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="author_2">Auteur 2</label>
                        <div class="col-md-4">
                            <input type="text" name="author_2" id="author_2" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="author_3">Auteur 3</label>
                        <div class="col-md-4">
                            <input type="text" name="author_3" id="author_3" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="author_4">Auteur 4</label>
                        <div class="col-md-4">
                            <input type="text" name="author_4" id="author_4" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="author_5">Auteur 5</label>
                        <div class="col-md-4">
                            <input type="text" name="author_5" id="author_5" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="book_pub">Publication <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="book_pub" id="book_pub" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="publisher_name">Editeur</label>
                        <div class="col-md-4">
                            <input type="text" name="publisher_name" id="publisher_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="isbn">ISBN <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-4">
                            <input type="text" name="isbn" id="isbn" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="copyright_year">Copyright &copy;</label>
                        <div class="col-md-3">
                            <input type="number" name="copyright_year" id="copyright_year" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="book_copies">Copies <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-3">
                            <input type="number" name="book_copies" step="1" min="1" max="1000" required="required" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="status">Statut <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-3">
                            <select name="status" id="status" class="select2_single form-control" tabindex="-1" required="required">
                                <option value="Nouveau">Nouveau</option>
                                <option value="Perdu">Perdu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="category">Categorie <span class="required" style="color:red;">*</span></label>
                        <div class="col-md-3">
                            <select name="category" id="category" class="select2_single form-control" tabindex="-1" required="required">
                                <option value="Info">Info</option>
                                <option value="Med">Med</option>
                                <option value="Droit">Droit</option>
                                <option value="Eco">Eco</option>
                                <option value="Gestion">Gestion</option>
                                <option value="Lettre">Lettre</option>
                                <option value="Langue">Langue</option>
                                <option value="Sciences">Sciences</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="image">Livre Image</label>
                        <div class="col-md-4">
                            <input type="file" style="height:44px;" name="image" id="image" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <a href="book.php" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Annuler</a>
                            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Valider</button>
                        </div>
                    </div>
                </form>
                <!-- le contenu se termine ici -->
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php'); ?>
