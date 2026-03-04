<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Acceuil / Profil Bibliothécaire /</small> Ajouter Bibliothécaire
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-plus"></i> Ajouter Bibliothécaire</h2>
                     
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- contenu commence ici -->

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Prénom <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="firstname" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Deuxième Prénom
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="middlename" placeholder="" id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div><span style="color:red;">Optionnel</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Nom <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="lastname" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Mail
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="email_id" placeholder="" id="first-name2" class="form-control col-md-7 col-xs-12" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
                                    </div><span style="color:red;">Optionnel</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Contact<span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="contact" placeholder="" id="first-name2" class="form-control col-md-7 col-xs-12" required="" pattern="^(05|06|07)[0-9]{8}$" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Identifiant <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="username" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Mot de passe <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="password" name="password" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Confirmer Mot de passe <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="password" name="confirm_password" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Admin Image
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" style="height:44px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="admin.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Annuler</button></a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Valider</button>
                                    </div>
                                </div>
                            </form>
							
							<?php	
							include ('include/dbcon.php');
							if (!isset($_FILES['image']['tmp_name'])) {
							echo "";
							}else{
							$file=$_FILES['image']['tmp_name'];
							$image = $_FILES["image"] ["name"];
							$image_name= addslashes($_FILES['image']['name']);
							$size = $_FILES["image"] ["size"];
							$error = $_FILES["image"] ["error"];
							{
										if($size > 10000000) //conditions du fichier
										{
										die("Format non autorisé ou taille du fichier trop grande!");
										}
										
									else
										{

									move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);			
									$profile=$_FILES["image"]["name"];
									$firstname = $_POST['firstname'];
									$middlename = $_POST['middlename'];
									$lastname = $_POST['lastname'];
                                    $email_id = $_POST['email_id'];
                                    $contact = $_POST['contact'];
									$username = $_POST['username'];
									$password = $_POST['password'];
									$confirm_password = $_POST['confirm_password'];
									
					
					$result=mysqli_query($con,"select * from admin WHERE username='$username' ") or die (mysqli_error($con));
					$row=mysqli_num_rows($result);
					if ($row > 0)
					{
					echo "<script>alert('Identifiant déjà utilisé!'); window.location='add_librarian.php'</script>";
					}
					elseif($password != $confirm_password)
					{
					echo "<script>alert('Les mot de passe ne correspondent pas!'); window.location='add_librarian.php'</script>";
					}else
					{		
						mysqli_query($con,"insert into admin (firstname, middlename, lastname,email_id,contact , username, password, confirm_password, admin_image, admin_added)
						values ('$firstname', '$middlename', '$lastname','$email_id','$contact', '$username', '$password', '$confirm_password', '$profile',NOW())")or die(mysqli_error($con));
						echo "<script>alert('Compte ajouté avec succès!'); window.location='admin.php'</script>";
					}
									}
									}
							}
								?>
						
                        <!-- contenu fini ici -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>