<html>
<head>
	<title>Person Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form-action'] ) ? $_POST['form-action'] : "";

	if($action == "update"){
		try{
			$sql = "update PERSON set FNAME = ?, LNAME = ?, EMAIL = ?, PHONE_AC = ?, PHONE = ?, PASS_WORD = ?, ROLE_ID = ?  where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['firstName-update'],
							$_POST['lastName-update'],
							$_POST['email-update'],
							$_POST['phoneAC-update'],
							$_POST['phone-update'],
							$_POST['password-update'],
							$_POST['roleID-update'],
							$_POST['record-id']));
			echo "Record was updated.";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ID, FNAME, LNAME, EMAIL, PHONE_AC, PHONE, PASS_WORD, ROLE_ID from PERSON where ID =:ID";
		$query = $con->prepare( $sql );
		$query->bindParam ( ':ID', $_REQUEST['record-id'],PDO::PARAM_INT );  
		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
		$firstName-current = $row['FNAME'];
		$lastName-current = $row['LNAME'];
		$email-current = $row['EMAIL'];
		$phoneAC-current = $row['PHONE_AC'];
		$phone-current = $row['PHONE'];
		$password-current = $row['PASS_WORD'];
		$roleID-current = $row['ROLE_ID'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
				<td>Firstname</td>
				<td><input type='text' name='firstName-update' value='<?php echo $firstName-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Lastname</td>
				<td><input type='text' name='lastName-update' value='<?php echo $lastName-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type='text' name='email-update'  value='<?php echo $email-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Area Code</td>
				<td><input type='text' name='phoneAC-update'  value='<?php echo $phoneAC-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type='text' name='phone-update'  value='<?php echo $phone-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type='password' name='password-update'  value='<?php echo $password-current;  ?>' /></td>
			</tr>
			<tr>
				<td>Role ID</td>
				<td><input type='text' name='roleID-update'  value='<?php echo $roleID-current;  ?>' /></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<!--so that we could identify what record is to be updated-->
					<input type='hidden' name='record-id' value='<?php echo $id ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form-action' value='update' />
					<input type='submit' value='Edit' />
					<a href='person.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>