<?php include ('include/dbcon.php');
$ID=$_GET['admin_id'];
?>
<?php include ('header.php'); ?>

<div class="page-title">
    <div class="title_left">
        <h3>
            <small>Accueil / Profil Bibliothécaire /</small> Modifier Bibliothécaire
        </h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Modifier Bibliothécaire</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <!-- contenu commence ici -->
<?php
$query=mysqli_query($con,"SELECT * FROM admin WHERE admin_id='$ID'") or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
?>

<form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
    <div class="form-group">
        <label class="control-label col-md-4" for="last-name">Image du Bibliothécaire
        </label>
        <div class="col-md-4">
            <a href="">
            <?php if($row['admin_image'] != ""): ?>
                <img src="upload/<?php echo $row['admin_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
            <?php else: ?>
                <img src="images/user.png" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
            <?php endif; ?>
            </a>
            <input type="file" style="height:44px; margin-top:10px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="first-name">Prénom
        </label>
        <div class="col-md-4">
            <input type="text" value="<?php echo $row['firstname']; ?>" name="firstname" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="first-name">Deuxième Prénom
        </label>
        <div class="col-md-3">
            <input type="text" name="middlename" value="<?php echo $row['middlename']; ?>" placeholder="" id="first-name2" class="form-control col-md-7 col-xs-12">
        </div><span style="color:red;">Optionnel</span>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="last-name">Nom de Famille
        </label>
        <div class="col-md-4">
            <input type="text" value="<?php echo $row['lastname']; ?>" name="lastname" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    

    <div class="form-group">
        <label class="control-label col-md-4" for="first-name">Email
        </label>
        <div class="col-md-3">
            <input type="text" name="email_id" value="<?php echo $row['email_id']; ?>" class="form-control col-md-7 col-xs-12" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
        </div><span style="color:red;">Optionnel</span>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="first-name">Contact <span class="required" style="color:red;">*</span>
        </label>
        <div class="col-md-3">
            <input type="text" name="contact" value="<?php echo $row['contact']; ?>" class="form-control col-md-7 col-xs-12" required pattern="[789][0-9]{9}$" maxlength="10">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="last-name">Mot de Passe
        </label>
        <div class="col-md-4">
            <input type="password" value="<?php echo $row['password']; ?>" name="password" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="last-name">Confirmer le Mot de Passe
        </label>
        <div class="col-md-4">
            <input type="password" value="<?php echo $row['confirm_password']; ?>" name="confirm_password" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <a href="admin.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Annuler</button></a>
            <button type="submit" name="update" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Mettre à Jour</button>
        </div>
    </div>
</form>

<?php
$id = $_GET['admin_id'];
if (isset($_POST['update'])) {
    $image = $_FILES["image"]["name"];
    $image_name = addslashes($_FILES['image']['name']);
    $size = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];

    if ($error > 0) {
        // Pas de nouvelle image uploadée
        $profile_image = $row['admin_image'];
    } else {
        if ($size > 10000000) {
            die("Format non autorisé ou taille de fichier trop grande !");
        }
        move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
        $profile_image = $_FILES["image"]["name"];
    }

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email_id = $_POST['email_id'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "<script>alert('Les mots de passe ne correspondent pas !'); window.location='admin.php'</script>";
    } else {
        mysqli_query($con, "UPDATE admin SET 
            firstname='$firstname',
            middlename='$middlename',
            lastname='$lastname',
            email_id='$email_id',
            contact='$contact',
            password='$password',
            confirm_password='$confirm_password',
            admin_image='$profile_image'
            WHERE admin_id='$id'") or die(mysqli_error($con));

        echo "<script>alert('Informations du bibliothécaire mises à jour avec succès !'); window.location='admin.php'</script>";
    }
}
?>

<!-- contenu se termine ici -->
</div>
</div>
</div>
</div>

<?php include ('footer.php'); ?>
