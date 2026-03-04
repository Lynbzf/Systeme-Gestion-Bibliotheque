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
		
				<center><h5 style = "font-style:Calibri; margin-top:-14px;"></h5>  Système de gestion de bibliothèque</center>
					
				</div><hr style="border: solid black 1px">
			<button type="submit" id="print" onclick="printPage()">Afficher</button>	
			<p style = "margin-left:30px; margin-top:5px; margin-bottom: 0px;font-size:14pt; font-style: italic; ">Liste des Membres&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <div align="right">
		<b style="color:blue;">Date Preparé:</b>
		<?php 
		echo date("l,d-m-Y"); ?>
        </div>			
		<br/>
<?php
						$result= mysqli_query($con,"SELECT * from book where book_title='".$_SESSION['book_title']."' AND book_pub='".$_SESSION['book_pub']."' order by book_id DESC ") OR die (mysqli_error($con));
?>
						<table class="table table-striped">
						  <thead>
								<tr>
								<tr>
									<th>Code-Barres</th>
									<th>Titre</th>
									<th>Auteur</th>
									<th>ISBN</th>
									<th>Publication</th>
									<th>Editeur</th>
									<th>Copyright</th>
								
									<th>Categorie</th>
									<th>Statut</th>
								</tr>
								</tr>
						  </thead>   
						  <tbody>
<?php
							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['book_id'];
?>
							<tr>
								<td	style="text-align:center;"><?php echo $row['book_barcode']; ?></td>
								<td	style="text-align:center;"><?php echo $row['book_title']; ?></td>
								<td	style="text-align:center;"><?php echo $row['author']; ?></td>
								<td	style="text-align:center;"><?php echo $row['isbn']; ?></td>
								<td	style="text-align:center;"><?php echo $row['book_pub']; ?></td>
								<td	style="text-align:center;"><?php echo $row['publisher_name']; ?></td>
								<td	style="text-align:center;"><?php echo $row['copyright_year']; ?></td> 
							
								<td	style="text-align:center;"><?php echo $row['category']; ?></td> 
								<td	style="text-align:center;"><?php echo $row['status']; ?></td> 
							</tr>
							
							<?php 
							}					
							?>
						  </tbody> 
					  </table> 

<br />
<br />
							<?php
								
								$user_query=mysqli_query($con,"select * from admin where admin_id='$id_session'")or die(mysql_error());
								$row=mysqli_fetch_array($user_query); {
							?>        <h2><i class="glyphicon glyphicon-user"></i> <?php echo '<span style="color:blue; font-size:15px;">Preparé par:'."<br /><br /> ".$row['firstname']." ".$row['lastname']." ".'</span>';?></h2>
								<?php } ?>


			</div>
	
	
	
	

	</div>
</body>


</html>