<html>
<head>
 	<title>Person Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form-action']) ? $_POST['form-action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into PERSON (FNAME,LNAME,EMAIL,PHONE_AC,PHONE,PASS_WORD,ROLE_ID)
			 	values (:FNAME,:LNAME,:EMAIL,:PHONE_AC,:PHONE,:PASS_WORD,:ROLE_ID)";  
			$query = $con->prepare($sql);  
			$query->execute(array(	':FNAME'=>$_POST['firstName-new'], 
							':LNAME'=>$_POST['lastName-new'], 
							':EMAIL'=>$_POST['email-new'], 
							':PHONE_AC'=>$_POST['phoneAC-new'],
							':PHONE'=>$_POST['phone-new'], 
							':PASS_WORD'=>$_POST['password-new'], 
							':ROLE_ID'=>$_POST['roleID-new']));
			echo "Record was saved.";
		}catch(PDOException $exception){ //to handle error
 	  		echo "Error: " . $exception->getMessage();}
	}  //end if create action
?>

<!--we have our html form here where user information will be entered-->

	<form action='#' method='post' border='0'>
		<table class="imagetable">
 			<tr>
 				<td>First Name</td>
 				<td><input type='text' name='firstName-new' /></td>
  			</tr>
 			<tr>
 				<td>Last Name</td>
		 		<td><input type='text' name='lastName-new' /></td>
			</tr>
 			<tr>
 				<td>Email</td>
		   		<td><input type='text' name='email-new' /></td>
			</tr>
	 		<tr>
 				<td>Area Code</td>
	 			<td><input type='text' name='phoneAC-new' /></td>
		 	</tr>
 			<tr>
 				<td>Phone Number</td>
		 		<td><input type='text' name='phone-new' /></td>
 			</tr>
	 		<tr>
 				<td>Password</td>
	 			<td><input type='password' name='password-new' /></td>
		 	</tr>
 			<tr>
 				<td>Role ID</td>
		 		<td><input type='text' name='roleID-new' /></td>
 			</tr>
			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form-action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='person.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
