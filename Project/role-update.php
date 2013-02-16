<html>
<head>
	<title>Role Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form_action'] ) ? $_POST['form_action'] : "";

	if($action == "update"){
		try{
			$sql = "update FP.ROLE set NAME = ? where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['name_update'],
							$_POST['record_id']));
			echo "Record was updated.";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ID, NAME from FP.ROLE where ID =:ID";
		$query = $con->prepare( $sql );
		$query->bindParam ( ':ID', $_REQUEST['record_id'],PDO::PARAM_INT );  
		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
		$name_current = $row['NAME'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
				<td>Name</td>
				<td><input type='text' name='name_update' value='<?php echo $name_current;  ?>' /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<!--so that we could identify what record is to be updated-->
					<input type='hidden' name='record_id' value='<?php echo $id ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form_action' value='update' />
					<input type='submit' value='Edit' />
					<a href='role.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>