<html>
<head>
	<title>Student Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form_action'] ) ? $_POST['form_action'] : "";

	if($action == "update"){
		try{
			$sql = "update FP.STUDENT set FNAME = ?, LNAME = ?, EMAIL = ?, PHONE_AC = ?, PHONE = ?, CURRENT_CLASS = ?, CASE_WORKER = ?  where ID = ?";
			$query = $con->prepare( $sql );
			$query->execute(array(	$_POST['firstName_update'],
							$_POST['lastName_update'],
							$_POST['email_update'],
							$_POST['phoneAC_update'],
							$_POST['phone_update'],
							$_POST['currentClass_update'],
							$_POST['caseWorker_update'],
							$_POST['record_id']));
			echo "Record was updated.";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ID, FNAME, LNAME, EMAIL, PHONE_AC, PHONE, CURRENT_CLASS, CASE_WORKER from FP.STUDENT where ID =:ID";
		$query = $con->prepare( $sql );
		$query->bindParam ( ':ID', $_REQUEST['record_id'],PDO::PARAM_INT );  
		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
		$firstName_current = $row['FNAME'];
		$lastName_current = $row['LNAME'];
		$email_current = $row['EMAIL'];
		$phoneAC_current = $row['PHONE_AC'];
		$phone_current = $row['PHONE'];
		$currentClass_current = $row['CURRENT_CLASS'];
		$caseWorker_current = $row['CASE_WORKER'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
				<td>First Name</td>
				<td><input type='text' name='firstName_update' value='<?php echo $firstName_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type='text' name='lastName_update' value='<?php echo $lastName_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type='text' name='email_update'  value='<?php echo $email_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Area Code</td>
				<td><input type='text' name='phoneAC_update'  value='<?php echo $phoneAC_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type='text' name='phone_update'  value='<?php echo $phone_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Current Class</td>
				<td><input type='text' name='currentClass_update'  value='<?php echo $currentClass_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Case Worker</td>
				<td><input type='text' name='caseWorker_update'  value='<?php echo $caseWorker_current;  ?>' /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<!--so that we could identify what record is to be updated-->
					<input type='hidden' name='record_id' value='<?php echo $id ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form_action' value='update' />
					<input type='submit' value='Edit' />
					<a href='student.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>