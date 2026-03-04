<?php include ('include/dbcon.php');
include('session.php');
?>
<html>

<head>
		<title>Système de gestion de bibliothèque</title>
		
<style>
.container {
	width:100%;
	margin:auto;
}
		 
.table {
    width: 100%;
    margin-bottom: 20px;
}	

.table-striped tbody > tr:nth-child(odd) > td,
.table-striped tbody > tr:nth-child(odd) > th {
    background-color: #f9f9f9;
}
		
@media print{
#print {
display:none;
}
}

#print {
	width: 90px;
    height: 30px;
    font-size: 18px;
    background: white;
    border-radius: 4px;
	margin-left:28px;
	cursor:hand;
}
		</style>
		
<script>
function printPage() {
    window.print();
}
</script>
</head>
<body>
	<div class = "container">
		<div id = "header">
				<center><h5 style = "font-style:Calibri; margin-top:-14px;"></h5>  Système de getsion de bibliothèque</center>
					
				</div><hr style="border: solid black 1px">
			<button type="submit" id="print" onclick="printPage()">Print</button>	
			<p style = "margin-left:30px; margin-top:5px; margin-bottom: 0px;font-size:14pt; font-style: italic; ">Liste des Membres&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <div align="right">
		<b style="color:blue;">Date Preparé:</b>
		<?php //include('currentdate.php');
		echo date("l,d-m-Y"); ?>
        </div>			
		<br/>
<?php
							$result= mysqli_query($con,"select * from user 
							order by user.user_id DESC ") or die (mysqli_error());
?>
						<table class="table table-striped">
						  <thead >
								<tr>
								<tr>
									<th style="text-align: center">Numéro de Membre</th>
									<th style="text-align: center">Nom du Membre</th>
									<th style="text-align: center">Genre</th>
									
									<th style="text-align: center">Type de Membre</th>
									<th style="text-align: center">Filière</th>
									<th style="text-align: center">Contact</th>
									<th style="text-align: center">Adresse</th>
									
									<th style="text-align: center">Date Ajouté</th>
								</tr>
								</tr>
						  </thead>   
						  <tbody>
<?php
							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['user_id'];
?>
							<tr>
								<td style="text-align:center;"><?php echo $row['roll_number']; ?></td>
								<td style="text-align:center;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td> 
								<td style="text-align:center;"><?php echo $row['gender']; ?></td> 
								<td style="text-align:center;"><?php echo $row['type']; ?></td> 
								<td style="text-align:center;"><?php echo $row['branch']; ?></td> 
								<td style="text-align:center;"><?php echo $row['contact']; ?></td> 
								<td style="text-align:center;"><?php echo $row['address']; ?></td> 
								<td style="text-align:center;"><?php echo date("M d, Y", strtotime($row['user_added'])); ?></td>
							</tr>
							
							
							
							<?php 
							}					
							?>
						  </tbody> 
					  </table> 

<br />
<br />
							<?php
								include('include/dbcon.php');
								

								$user_query=mysqli_query($con,"select * from admin where admin_id='$id_session'")or die(mysqli_error($con));
								$row=mysqli_fetch_array($user_query); 
								{
							?>        <h2><span style="font-size: 15px" class="glyphicon glyphicon-user"></span> 
								<?php echo '<span style="color:blue; font-size:13px;">Preparé par:'."<br /><br /> ".$row['firstname']." ".$row['lastname']." ".'</span>';?></h2>
								<?php } ?>


			</div>
	
	
	
	

	</div>
</body>


</html>