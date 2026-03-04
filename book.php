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
                    <div class="x_title">
                        <h2><i class="fa fa-search"></i> Rechercher des Livres Spécifiques</h2>
                         <ul class="nav navbar-right panel_toolbox">
                            <li>
                                
                                <a href="add_book.php" style="background:none;">
                                <button class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter Livre</button>
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- Formulaire de recherche -->
                        <form method="post" action="book_search.php" class="form-inline">
                            <div class="form-group">
                                <select name="book_title" class="select2_single form-control" tabindex="-1" >
                                    <option value="0">Sélectionner Titre</option>
                                    <?php
                                    $result_titles = mysqli_query($con, "SELECT DISTINCT book_title FROM book ORDER BY book_title ASC") or die (mysqli_error($con));
                                    while ($row_title = mysqli_fetch_array($result_titles)) {
                                        echo '<option value="' . htmlspecialchars($row_title['book_title']) . '">' . htmlspecialchars($row_title['book_title']) . '</option>';
                                    }
                                    ?>
                                </select>  
                            </div>
                            <div class="form-group">
                                 <select name="publisher_name" class="select2_single form-control" tabindex="-1" >
                                    <option value="0">Sélectionner Éditeur</option>
                                    <?php
                                    $result_pubs = mysqli_query($con, "SELECT DISTINCT publisher_name FROM book ORDER BY publisher_name ASC") or die (mysqli_error($con));
                                    while ($row_pub = mysqli_fetch_array($result_pubs)) {
                                        echo '<option value="' . htmlspecialchars($row_pub['publisher_name']) . '">' . htmlspecialchars($row_pub['publisher_name']) . '</option>';
                                    }
                                    ?>
                                </select>  
                            </div>
                            <button name="submit" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Rechercher</button>
                        </form>
                        <div class="ln_solid"></div>
                        <!-- Fin du formulaire de recherche -->
                    </div>
                </div>

                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-book"></i> Tous les Livres</h2>
                        <ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="book.php">Tous les Livres</a></li>
                            <li role="presentation"><a href="lost_books.php">Livres Perdus</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- le contenu commence ici -->
						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="all_books_table">
								
							<thead>
								<tr>
									<th style="width:100px;">Image</th>
									<th>Code-Barres</th>
									<th>Titre</th>
									<th>Auteur(s)</th>
									<th>Catégorie</th>
									<th>Statut</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result = mysqli_query($con, "SELECT * FROM book ORDER BY book_id DESC") or die(mysqli_error($con));
							while ($row = mysqli_fetch_array($result)) {
    							$id = $row['book_id'];
							?>
							<tr>
								<td>
								<?php if($row['book_image'] != ""): ?>
								<img src="upload/<?php echo htmlspecialchars($row['book_image']); ?>" class="img-thumbnail" width="75px" height="50px">
								<?php else: ?>
								<img src="images/book_image.jpg" class="img-thumbnail" width="75px" height="50px">
								<?php endif; ?>
								</td>
								<td><a target="_blank" href="print_barcode_individual.php?code=<?php echo urlencode($row['book_barcode']); ?>"><?php echo htmlspecialchars($row['book_barcode']); ?></a></td>
								<td style="word-wrap: break-word; width: 20em;"><?php echo htmlspecialchars($row['book_title']); ?></td>
								<td style="word-wrap: break-word; width: 15em;"><?php echo htmlspecialchars($row['author']); ?></td>
								<td><?php echo htmlspecialchars($row['category']); ?></td> 
								<td><?php echo htmlspecialchars($row['status']); ?></td> 
								<td>
									<a class="btn btn-primary btn-xs" for="ViewAdmin" href="view_book.php?book_id=<?php echo $id; ?>">
										<i class="fa fa-search"></i> Voir
									</a>
									<a class="btn btn-warning btn-xs" for="ViewAdmin" href="edit_book.php?book_id=<?php echo $id; ?>">
									<i class="fa fa-edit"></i> Modifier
									</a>
									<a class="btn btn-danger btn-xs" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i> Supprimer
									</a>
			
									<!-- fenêtre modale suppression livre -->
									<div class="modal fade" id="delete<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Supprimer Livre</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Êtes-vous sûr de vouloir supprimer ce livre ?
												</div>
										</div>
										<div class="modal-footer">
												<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> Non</button>
												<a href="delete_book.php?book_id=<?php echo $id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Oui</a>
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

<!-- Script pour activer DataTables -->
<script>
$(document).ready(function() {
    $('#all_books_table').DataTable({
        "paging": true,       // Pagination activée
        "searching": true,    // Barre de recherche activée
        "ordering": true,     // Tri des colonnes activé
        "info": true,         // Affiche "Affichage de 1 à X sur Y entrées"
        "responsive": true    // Table responsive
    });
});
</script>

<?php include ('footer.php'); ?>
