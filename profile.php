<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Acceuil / Profil Administrateur</small> / Voir
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-info"></i> Information Individuelle</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                       

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
								
							<thead>
								<tr>
									<th>Image</th>
									<th>Prénom</th>
									<th>Deuxième Prénom</th>
									<th>Nom</th>
									<th>Identifiant</th>
									<th>Mot de Passe</th>
									<th>Date Ajouté</th>
								</tr>
							</thead>
							<tbody>
<?php
			   
		if (isset($_GET['admin_id']))
		$id=$_GET['admin_id'];
		$result1 = mysqli_query($con,"SELECT * FROM admin WHERE admin_id='$id'");
		while($row = mysqli_fetch_array($result1)){
		?>
							<tr>
								<td>
									<?php if($row['admin_image'] != ""): ?>
									<img src="upload/<?php echo $row['admin_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
									<?php else: ?>
									<img src="images/user.png" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
									<?php endif; ?>	
								</td> 
								<td><?php echo $row['firstname']; ?></td> 
								<td><?php echo $row['middlename']; ?></td> 
								<td><?php echo $row['lastname']; ?></td>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['password']; ?></td> 
								<td><?php echo date("M d, Y h:m:s a", strtotime($row['admin_added'])); ?></td> 
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