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
			$sql = "update FP.PERSON set FNAME = ?, LNAME = ?, EMAIL = ?, PHONE_AC = ?, PHONE = ?, PASS_WORD = ?, ROLE_ID = ?  where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['firstname_update'],
							$_POST['lastname_update'],
							$_POST['email_update'],
							$_POST['phoneAC_update'],
							$_POST['phone_update'],
							$_POST['password_update'],
							$_POST['roleID_update'],
							$_POST['record_id']));
			echo "Record was updated."; 
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ID, FNAME, LNAME, EMAIL, PHONE_AC, PHONE, PASS_WORD, ROLE_ID from FP.PERSON where ID = :ID";
     		$query = $con->prepare( $sql );
     		$query->bindParam ( ':ID', $_REQUEST['record_id'],PDO::PARAM_INT );  
     		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
     		$firstname_current = $row['FNAME'];
     		$lastname_current = $row['LNAME'];
     		$email_current = $row['EMAIL'];
     		$phoneAC_current = $row['PHONE_AC'];
     		$phone_current = $row['PHONE'];
     		$password_current = $row['PASS_WORD'];
     		$roleID_current = $row['ROLE_ID'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
             			<td>Firstname</td>
             			<td><input type='text' name='firstname_update' value='<?php echo $firstname_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Lastname</td>
             			<td><input type='text' name='lastname_update' value='<?php echo $lastname_current;  ?>' /></td>
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
             			<td>Phone Number</td>
             			<td><input type='text' name='phone_update'  value='<?php echo $phone_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Password</td>
             			<td><input type='password' name='password_update'  value='<?php echo $password_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Role ID</td>
             			<td><input type='text' name='roleID_update'  value='<?php echo $roleID_current;  ?>' /></td>
         		</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<!--so that we could identify what record is to be updated-->
					<input type='hidden' name='record_id' value='<?php echo $id ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form_action' value='update' />
					<input type='submit' value='Edit' />
					<a href='person.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>