<html>
<head>
	<title>Term Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form-action'] ) ? $_POST['form-action'] : "";

	if($action == "update"){
		try{
			$sql = "update TERM set ACAD_YEAR = ?, START_DATE = ?, END_DATE = ?;
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['firstName-update'],
							$_POST['acadYear-update'],
							$_POST['startDate-update'],
							$_POST['endDate-update']));
			echo "Record was updated.";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ACAD_YEAR, START_DATE, END_DATE from TERM where ID =:ID";
		$query = $con->prepare( $sql );
		$query->bindParam ( ':ID', $_REQUEST['record-id'],PDO::PARAM_INT );  
		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
		$acadYear-current = $row['ACAD_YEAR'];
		$startDate-current = $row['START_DATE'];
		$endDate-current = $row['END_DATE'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
				<td>Academic Year</td>
				<td><input type='text' name='acadYear-update' value='<?php echo $acadYear-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Start Date</td>
				<td><input type='text' name='startDate-update' value='<?php echo $startDate-current;  ?>' /></td>
			</tr>
			<tr>
				<td>End Date</td>
				<td><input type='text' name='endDate-update'  value='<?php echo $endDate-current;  ?>' /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<!--so that we could identify what record is to be updated-->
					<input type='hidden' name='record-id' value='<?php echo $id ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form-action' value='update' />
					<input type='submit' value='Edit' />
					<a href='term.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>