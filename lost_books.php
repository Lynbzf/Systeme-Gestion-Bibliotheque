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
							<a href="book_print_lost.php" target="_blank" style="background:none;">
							<button class="btn btn-danger pull-right"><i class="fa fa-print"></i> Imprimer la Liste des Livres</button>
							</a>
							
							<br />
							<br />
                    <div class="x_title">
                        <h2><i class="fa fa-book"></i> Liste des Livres</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="add_book.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter un Livre</button>
							</a>
							</li>
                            
                        </ul>
                        <div class="clearfix"></div>
							<ul class="nav nav-pills">
								<li role="presentation"><a href="book.php">Tous</a></li>
								<li role="presentation" class="active"><a href="lost_books.php">Livres Perdus</a></li>
							</ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- le contenu commence ici -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
									<th style="width:100px;">Image du Livre</th>
									<th>Code-barres</th>
									<th>Titre</th>
									<th>ISBN</th>
									<th>Auteur(s)</th>
								
									<th>Catégorie</th>
									<th>Statut</th>
									<th>Remarques</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysqli_query($con,"select * from book where status = 'Lost' ") or die (mysql_error());
							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['book_id'];
							?>
							<tr>
								<td>
								<?php if($row['book_image'] != ""): ?>
								<img src="upload/<?php echo $row['book_image']; ?>" class="img-thumbnail" width="75px" height="50px">
								<?php else: ?>
								<img src="images/book_image.jpg" class="img-thumbnail" width="75px" height="50px">
								<?php endif; ?>
								</td>  
                                <!-- soit ce <td><a target="_blank" href="view_book_barcode.php?code=<?php // echo $row['book_barcode']; ?>"><?php // echo $row['book_barcode']; ?></a></td> -->
								<td><a target="_blank" href="print_barcode_individual.php?code=<?php echo $row['book_barcode']; ?>"><?php echo $row['book_barcode']; ?></a></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['book_title']; ?></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['isbn']; ?></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['author']."<br />".$row['author_2']."<br />".$row['author_3']."<br />".$row['author_4']."<br />".$row['author_5']; ?></td>
								
								<td><?php echo $row['category']; ?></td> 
								<td><?php echo $row['status']; ?></td> 
								<td><?php echo $row['remarks']; ?></td> 
								<td>
									<a class="btn btn-primary" for="ViewAdmin" href="view_book.php<?php echo '?book_id='.$id; ?>">
										<i class="fa fa-search"></i>
									</a>
									<a class="btn btn-warning" for="ViewAdmin" href="edit_book.php<?php echo '?book_id='.$id; ?>">
									<i class="fa fa-edit"></i>
									</a>
						<!--			<a class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i>
									</a>
			
									 modal de suppression utilisateur -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Utilisateur</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Êtes-vous sûr de vouloir supprimer ?
												</div>
												<div class="modal-footer">
												<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> Non</button>
												<a href="delete_user.php<?php echo '?book_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Oui</a>
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
