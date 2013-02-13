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
			$query->execute(array(	$_POST['firstname'],
							$_POST['lastname'],
							$_POST['email'],
							$_POST['phoneAC'],
							$_POST['phone'],
							$_POST['password'],
							$_POST['roleID'],
							$_POST['record-id']));
			echo "Record was updated."; 
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ID, FNAME, LNAME, EMAIL, PHONE_AC, PHONE, PASS_WORD, ROLE_ID from FP.PERSON where ID = :ID";
     		$query = $con->prepare( $sql );
     		$query->bindParam ( ':ID', $_REQUEST['record-id'],PDO::PARAM_INT );  
     		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
     		$firstname = $row['FNAME'];
     		$lastname = $row['LNAME'];
     		$email = $row['EMAIL'];
     		$phoneAC = $row['PHONE_AC'];
     		$phone = $row['PHONE'];
     		$password = $row['PASS_WORD'];
     		$roleID = $row['ROLE_ID'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
             			<td>Firstname</td>
             			<td><input type='text' name='firstname' value='<?php echo $firstname;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Lastname</td>
             			<td><input type='text' name='lastname' value='<?php echo $lastname;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Email</td>
             			<td><input type='text' name='email'  value='<?php echo $email;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Area Code</td>
             			<td><input type='text' name='phoneAC'  value='<?php echo $phoneAC;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Phone Number</td>
             			<td><input type='text' name='phone'  value='<?php echo $phone;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Password</td>
             			<td><input type='password' name='password'  value='<?php echo $password;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Role ID</td>
             			<td><input type='text' name='roleID'  value='<?php echo $roleID;  ?>' /></td>
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