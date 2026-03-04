<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Accueil /</small> Historique
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-users"></i> Historique des membres</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="user_log_print.php" target="_blank" style="background:none;">
							<button class="btn btn-danger"><i class="fa fa-print"></i> Imprimer</button>
							</a>
							</li>
                         <li>
                        </ul>
                        <div class="clearfix"></div>
		<!-- tri -->
						<form method="POST" action="user_log_search.php" class="form-inline">
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="datefrom" class="form-control has-feedback-left" placeholder="Date de début" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(succès)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="dateto" class="form-control has-feedback-left" placeholder="Date de fin" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(succès)</span>
                                        </div>
                                    </div>
                                </div>
								
								<button type="submit" name="search" class="btn btn-primary btn-outline">
                                    <i class="fa fa-calendar-o"></i> Rechercher par date de connexion
                                </button>
								
						</form>
                    </div>
                    <div class="x_content">
                        <!-- le contenu commence ici -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
									<th style="width:160px;">Nom</th>
									<th style="width:160px;">Type de membre</th>
									<th style="width:160px;">Date de connexion</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysqli_query($con,"select * from user_log 
							order by user_log.date_log DESC ") or die (mysqli_error($con));
							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['user_log_id'];
							?>
							<tr>
				
								<td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td>
								<td><?php echo $row['admin_type']; ?></td>
								<td><?php echo date("M d, Y h:i:s a", strtotime($row['date_log'])); ?></td> 
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
