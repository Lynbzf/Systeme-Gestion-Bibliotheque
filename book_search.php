<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Accueil /</small> Livres
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
							<a href="book_print.php" target="_blank" style="background:none;">
							<button class="btn btn-danger pull-right"><i class="fa fa-print"></i> Imprimer la Liste des Livres</button>
							</a>
							<a href="print_barcode_book.php" target="_blank" style="background:none;">
							<button class="btn btn-danger pull-right"><i class="fa fa-print"></i> Imprimer le Code-Barres des Livres</button>
							</a>
							<br />
							<br />
                    <div class="x_title">
                        <h2><i class="fa fa-book"></i> Liste des Livres</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="add_book.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter Livre</button>
							</a>
							</li>
                        </ul>
                        <div class="clearfix"></div>
							<ul class="nav nav-pills">
								<li role="presentation" class="active"><a href="book.php">Tous</a></li>
								<li role="presentation"><a href="lost_books.php">Livres Perdus</a></li>
							</ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- contenu commence ici -->
                        <div class="row">
                        	
                        		<form method="post" action="">
                        			<div class="col-md-2">
                                        <select name="book_title" class="select2_single form-control" required="required" tabindex="-1" >
										<option value="0">Sélectionner Titre</option>
										<?php
										$result= mysqli_query($con,"select distinct book_title from book") or die (mysqli_error($con));
										while ($row= mysqli_fetch_array ($result) ){
										$id=$row['book_id'];
										?>
                                            <option value="<?php echo $row['book_title']; ?>"><?php echo $row['book_title']; ?></option>
										<?php } ?>
                                        </select>  
                                    </div>

                                     <div class="col-md-2" style="margin-left: 5px">

                                         <select name="book_pub" class="select2_single form-control" required="required" tabindex="-1" >
										<option value="0">Sélectionner Éditeur</option>
										<?php
										$result= mysqli_query($con,"select distinct book_pub from book") or die (mysqli_error($con));
										while ($row= mysqli_fetch_array ($result) ){
										$id=$row['book_id'];
										?>
                                            <option value="<?php echo $row['book_pub']; ?>"><?php echo $row['book_pub']; ?></option>
										<?php } ?>
                                        </select>  
                                    </div>
							
										<button name="submit" type="submit" class="btn btn-primary" style=""><i class="glyphicon glyphicon-log-in"></i> Valider</button>
								</form>
                        	
                        </div>
                        
						<?php
                        $book_title = $_POST['book_title'];
						$book_pub = $_POST['book_pub'];
                    	$result= mysqli_query($con,"SELECT COUNT(book_id) AS total from book where book_title='$book_title' AND book_pub='$book_pub' ") OR die (mysqli_error($con));
                    	$row=mysqli_fetch_assoc($result);
                    	$count=$row['total'];
                    	echo "<span style='color:red;font-size:16px;font-weight:bold;Times New Roman, Times, serif';>Nombre Total de Livres = ".$count."</span";
                        ?>
                        <br><br><br>


                        <!-- Affichage du résultat de la recherche -->
                        <div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
									<th>Code-Barres</th>
									<th>Titre</th>
									<th>Auteurs</th>
									<th>Éditeur</th>
									<th>Catégorie</th>
									<th>Statut</th>
									<th>Remarques</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
<?php 
								$_SESSION['book_title'] = $_POST['book_title'];
								$_SESSION['book_pub'] = $_POST['book_pub'];
?>
								
							
							<?php
									

							$result= mysqli_query($con,"SELECT * from book where book_title='$book_title' AND book_pub='$book_pub' order by book_id DESC ") OR die (mysqli_error($con));
						

							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['book_id'];
							?>
							<tr>
								<td><a target="_blank" href="print_barcode_individual.php?code=<?php echo $row['book_barcode']; ?>"><?php echo $row['book_barcode']; ?></a></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['book_title']; ?></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['author']."<br />".$row['author_2']."<br />".$row['author_3']."<br />".$row['author_4']."<br />".$row['author_5']; ?></td>
								<td><?php echo $row['book_pub']; ?></td> 
								<td><?php echo $row['category']; ?></td> 
								<td><?php echo $row['status']; ?></td> 
								<td><?php echo $row['remarks']; ?></td> 
								<td>
									<a class="btn btn-primary" for="ViewAdmin" href="view_book.php<?php echo '?book_id='.$id; ?>">
										<i class="fa fa-search"></i> Voir
									</a>
									<a class="btn btn-warning" for="ViewAdmin" href="edit_book.php<?php echo '?book_id='.$id; ?>">
									<i class="fa fa-edit"></i> Modifier
									</a>
									<?php
									$user_query=mysqli_query($con,"select *  from admin where admin_id='$id_session'")or die(mysqli_error($con));
										$row=mysqli_fetch_array($user_query);


									if($row['admin_type']=='Admin') { ?>
									<a class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i> Supprimer
									</a>
									<?php } ?>
			
									<!-- fenêtre modale suppression livre -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Supprimer Livre</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Êtes-vous sûr de vouloir supprimer ce livre ?
												</div>
												<div class="modal-footer">
												<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> Non</button>
												<a href="delete_book.php<?php echo '?book_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Oui</a>
												</div>
										</div>
										</div>
									</div>
									</div>
								</td> 
							</tr>
							<?php  } ?>
							</tbody>
							</table>
						</div>
						
                        <!-- fin des livres -->

						
                        <!-- contenu se termine ici -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>
