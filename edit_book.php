<?php include ('include/dbcon.php');
$ID=$_GET['book_id'];
 ?>
<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Acceuil / Livres /</small> Modifier Informations Livre
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-pencil"></i> Modifier Livre</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- contenu commence ici -->
<?php
  $query=mysqli_query($con,"select * from book where book_id='$ID'")or die(mysql_error());
$row=mysqli_fetch_array($query);
  ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Livre Image
                                    </label>
                                    <div class="col-md-4">
										<?php if($row['book_image'] != ""): ?>
										<img src="upload/<?php echo $row['book_image']; ?>" width="100px" height="100px" style="border:1px solid black; border-radius:5px;">
										<?php else: ?>
										<img src="images/book_image.jpg" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
										<?php endif; ?>
										
                                        <input type="file" style="height:44px; margin-top:10px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Titre <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="book_title" value="<?php echo $row['book_title']; ?>" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Auteur 1 <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="author" id="first-name2" value="<?php echo $row['author']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Auteur 2
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="author_2" id="first-name2" value="<?php echo $row['author_2']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Auteur 3
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="author_3" id="first-name2" value="<?php echo $row['author_3']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Auteur 4
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="author_4" id="first-name2" value="<?php echo $row['author_4']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Auteur 5
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="author_5" id="first-name2" value="<?php echo $row['author_5']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Publication <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="book_pub" value="<?php echo $row['book_pub']; ?>" id="last-name2" class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Editeur
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="publisher_name" value="<?php echo $row['publisher_name']; ?>" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">ISBN <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="isbn" id="last-name2" value="<?php echo $row['isbn']; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Copyright &copy;
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="copyright_year" value="<?php echo $row['copyright_year']; ?>" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Statut <span class="required" style="color:red;">*</span>
                                    </label>
									<div class="col-md-3">
                                        <select name="status" class="select2_single form-control" tabindex="" >
                                            
											<option value="Nouveau">Nouveau</option>
											<option value="Perdu">Perdu</option>											
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Categorie <span class="required" style="color:red;">*</span>
                                    </label>
									<div class="col-md-3">
                                        <select name="category" class="select2_single form-control" tabindex="-1" required="required">
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
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="book.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Annuler</button></a>
                                        <button type="submit" name="update11" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Mettre à Jour</button>
                                    </div>
                                </div>
                            </form>
							
<?php
$id =$_GET['book_id'];
if (isset($_POST['update11'])) {

    $image = $_FILES["image"]["name"];
    $size = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];

    if ($error > 0) {
        $profile = $row['book_image']; // pas de changement d'image
    } else {
        if($size > 10000000) {
            die("Format non autorisé ou taille du fichier trop grande!");
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $image);            
        $profile = $image;
    }

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

    $remark = ($status == 'Lost') ? 'Not Available' : 'Available';

    // === Requête préparée sécurisée ===
    $stmt = mysqli_prepare($con, "UPDATE book SET 
        book_title = ?, 
        category = ?, 
        author = ?, 
        author_2 = ?, 
        author_3 = ?, 
        author_4 = ?, 
        author_5 = ?, 
        book_pub = ?, 
        publisher_name = ?, 
        isbn = ?, 
        copyright_year = ?, 
        status = ?, 
        book_image = ?, 
        remarks = ? 
        WHERE book_id = ?");

    mysqli_stmt_bind_param(
        $stmt, 
        "ssssssssssssssi", 
        $book_title, 
        $category, 
        $author, 
        $author_2, 
        $author_3, 
        $author_4, 
        $author_5, 
        $book_pub, 
        $publisher_name, 
        $isbn, 
        $copyright_year, 
        $status, 
        $profile, 
        $remark,
        $id
    );

    mysqli_stmt_execute($stmt) or die(mysqli_error($con));
    mysqli_stmt_close($stmt);

    echo "<script>alert('Informations du livre mises à jour avec succès!'); window.location='book.php'</script>";
}

?>
						
                        <!-- contenu se termine ici -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>