<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Acceuil /</small> Livres Empruntés
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-file"></i> Listes des Livres</h2>
                      
                        <div class="clearfix"></div>
						
						<form method="POST" action="borrowed_book_search.php" class="form-inline">
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="datefrom" class="form-control has-feedback-left" placeholder="Date From" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="dateto" class="form-control has-feedback-left" placeholder="Date To" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                            
								<button type="submit" name="search" class="btn btn-primary btn-outline"><i class="fa fa-calendar-o"></i> Chercher par Date de Transaction</button>
								
						</form>
						
						<span style="float:left;">
					<?php 
                    include('include/dbcon.php'); // connexion à la base

                    $result = mysqli_query($con, "SELECT COUNT(*) as total FROM report");
                    $count = mysqli_fetch_assoc($result);

                    $result1 = mysqli_query($con, "SELECT COUNT(*) as total FROM report WHERE detail_action = 'Livre Emprunté'");
                    $count1 = mysqli_fetch_assoc($result1);

                    $result2 = mysqli_query($con, "SELECT COUNT(*) as total FROM report WHERE detail_action = 'Livre Rendu'");
                    $count2 = mysqli_fetch_assoc($result2);
                    ?>
			
				</span>
				
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>