<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Acceuil / Livres</small> / Voir
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-info"></i> Information Individuelle</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="book.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-arrow-left"></i> Retour</button>
							</a>
							</li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
								
							<thead>
								<tr>
									<th style="width:100px;">Image du Livre</th>
									<th>Code-Barres</th>
									<th>Titre</th>
									<th>Auteur/s</th>
									<th>ISBN</th>
									<th>Publication</th>
									<th>Editeur</th>
									<th>Copyright</th>
								
									<th>Categorie</th>
									<th>Statut</th>
								</tr>
							</thead>
							<tbody>
<?php
			   
		if (isset($_GET['book_id']))
		$id=$_GET['book_id'];
		$result1 = mysqli_query($con,"SELECT * FROM book WHERE book_id='$id'");
		while($row = mysqli_fetch_array($result1)){
		?>
							<tr>
								<td>
								<?php if($row['book_image'] != ""): ?>
								<img src="upload/<?php echo $row['book_image']; ?>" width="150px" height="180px" style="border:1px solid black; border-radius:5px;">
								<?php else: ?>
								<img src="images/book_image.jpg" width="150px" height="180px" style="border:1px solid black; border-radius:5px;">
								<?php endif; ?>
								</td> 
								<td><?php echo $row['book_barcode']; ?></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['book_title']; ?></td>
								<td style="word-wrap: break-word; width: 10em;"><?php echo $row['author']."<br />".$row['author_2']."<br />".$row['author_3']."<br />".$row['author_4']."<br />".$row['author_5']; ?></td>
								<td><?php echo $row['isbn']; ?></td>
								<td><?php echo $row['book_pub']; ?></td>
								<td><?php echo $row['publisher_name']; ?></td>
								<td><?php echo $row['copyright_year']; ?></td> 
								
								<td><?php echo $row['category']; ?></td> 
								<td><?php echo $row['status']; ?></td> 
							</tr>
							<?php } ?>
							</tbody>
							</table>
						</div>
						
                    
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>