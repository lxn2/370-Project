<html>
<head>
 	<title>Term Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form-action']) ? $_POST['form-action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into PERSON (ACAD_YEAR,START_DATE,END_DATE)
			 	values (:ACAD_YEAR,:START_DATE,:END_DATE)";  
			$query = $con->prepare($sql);  
			$query->execute(array(	 
							':ACAD_YEAR'=>$_POST['acadYear-new'], 
							':START_DATE'=>$_POST['startDate-new'], 
							':END_DATE'=>$_POST['endDate-new']));
			echo "Record was saved.";
		}catch(PDOException $exception){ //to handle error
 	  		echo "Error: " . $exception->getMessage();}
	}  //end if create action
?>

<!--we have our html form here where user information will be entered-->

	<form action='#' method='post' border='0'>
		<table class="imagetable">
 			<tr>
 				<td>Academic Year</td>
 				<td><input type='text' name='acadYear-new' /></td>
  			</tr>
 			<tr>
 				<td>Start Date</td>
		 		<td><input type='text' name='startDate-new' /></td>
			</tr>
 			<tr>
 				<td>End Date</td>
		   		<td><input type='text' name='endDate-new' /></td>
			</tr>

			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form-action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='term.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
