<?php include ('header.php');
?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Accueil /</small>Profil Bibliothécaire
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-info"></i>Informations du Bibliothécaire</h2>
                        <ul class="nav navbar-right panel_toolbox">		
                            <li>
							<a href="add_librarian.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-plus"></i>Ajouter Bibliothécaire</button>
							</a>
							</li>
					
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- le contenu commence ici -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
									<th>Image</th>
									<th>Nom Complet</th>
									<th>Type d’Utilisateur</th>	
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysqli_query($con,"select * from admin order by admin_id ASC") or die (mysqli_error($con));
							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['admin_id'];
							?>
							<tr>
								<td>
									<?php if($row['admin_image'] != ""): ?>
									<img src="upload/<?php echo $row['admin_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
									<?php else: ?>
									<img src="images/user.png" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
									<?php endif; ?>	
								</td> 
								<td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td>
								<td><?php echo $row['admin_type']; ?></td>
								<td>
									<a class="btn btn-primary" for="ViewAdmin" href="view_admin.php<?php echo '?admin_id='.$id; ?>">
										<i class="fa fa-search"></i>
									</a>
									<?php //if ($_SESSION['id'] == $id) { ?>
									<a class="btn btn-warning" for="ViewAdmin" href="edit_admin.php<?php echo '?admin_id='.$id; ?>">
										<i class="fa fa-edit"></i>
									</a> <?php //} 
									 ?>
									<?php if ($_SESSION['id'] <> $id) { ?>

									<a class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i>
									</a> <?php } ?>
			
									<!-- fenêtre modale de suppression administrateur -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Administrateur</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Êtes-vous sûr de vouloir supprimer ?
												</div>
												<div class="modal-footer">
												<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> Non</button>
												<a href="delete_admin.php<?php echo '?admin_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Oui</a>
												</div>
										</div>
										</div>
									</div>
									</div>
								</td> 
							</tr>
							<?php } ?>
							</tbody>
							</table>
						</div>
						
                        <!-- le contenu se termine ici -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>
