<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Accueil / </small>Ajouter Membres
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    
                    <div class="x_content">
                        <!-- le contenu commence ici -->

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Numéro Membre | ID <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" name="roll_number" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Prénom <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="firstname" placeholder="Entrer le prénom" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Deuxième Prénom
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="middlename" class="form-control col-md-7 col-xs-12">
                                    </div> <span style="color:red;">Optionnel</span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Nom <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="lastname" placeholder="Entrer le nom" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="tel" autocomplete="off"  maxlength="10" name="contact" id="last-name2" class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Genre <span class="required" style="color:red;">*</span>
                                    </label>
									<div class="col-md-3">
                                        <select name="gender" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="Male">Homme</option>
                                            <option value="Female">Femme</option>
                                        </select>
                                    </div>
                                </div>	
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Type de Membre <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <select name="type" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="Étudiant">Étudiant</option>
                                            <option value="Enseignant">Enseignant</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Filière <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <select name="branch" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="N/A">N/A</option>
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
                                    <label class="control-label col-md-4" for="last-name">Adresse <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="address" id="last-name2" class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="member.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Annuler</button></a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Valider</button>
                                    </div>
                                </div>
                            </form>
							
							<?php	
							include ('include/dbcon.php');
                            if (isset($_POST['submit'])){
				                	$roll_number = $_POST['roll_number'];
									$firstname = $_POST['firstname'];
									$middlename = $_POST['middlename'];
									$lastname = $_POST['lastname'];
									$contact = $_POST['contact'];
									$gender = $_POST['gender'];
                                    $type = $_POST['type'];
                                    $branch = $_POST['branch'];
									$address = $_POST['address'];
								
                                $regex_num = "/^(05|06|07)[0-9]{8}$/";

									
								$result=mysqli_query($con,"select * from user WHERE roll_number='$roll_number' OR contact='$contact'") or die (mysqli_error($con));
								$row=mysqli_num_rows($result);
								if ($row > 0)
								{
									echo "<script>alert('Numéro Membre OU Contact déjà existant !'); window.location='member.php'</script>";
								}else if (!preg_match($regex_num, $contact)) {
                                    echo "<script>alert('Numéro de contact non valide'); window.location='member.php'</script>";
								}else
								{		
									mysqli_query($con,"insert into user (roll_number,firstname, middlename, lastname, contact, gender, address, type, branch, user_added)
									values ('$roll_number','$firstname', '$middlename', '$lastname', '$contact', '$gender', '$address', '$type', '$branch', NOW())")or die(mysqli_error($con));
									echo "<script>alert('Utilisateur ajouté avec succès !'); window.location='member.php'</script>";
								}
							}
							?>
						
                        <!-- le contenu se termine ici -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>
