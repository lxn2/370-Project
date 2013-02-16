<html>
<head>
 	<title>Person Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into FP.PERSON (FNAME,LNAME,EMAIL,PHONE_AC,PHONE,PASS_WORD,ROLE_ID)
			 	values (:FNAME,:LNAME,:EMAIL,:PHONE_AC,:PHONE,:PASS_WORD,:ROLE_ID)";  
			$query = $con->prepare($sql);  
			$query->execute(array(	':FNAME'=>$_POST['firstName_new'], 
							':LNAME'=>$_POST['lastName_new'], 
							':EMAIL'=>$_POST['email_new'], 
							':PHONE_AC'=>$_POST['phoneAC_new'],
							':PHONE'=>$_POST['phone_new'], 
							':PASS_WORD'=>$_POST['password_new'], 
							':ROLE_ID'=>$_POST['roleID_new']));
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
 				<td><input type='text' name='firstName_new' /></td>
  			</tr>
 			<tr>
 				<td>Last Name</td>
		 		<td><input type='text' name='lastName_new' /></td>
			</tr>
 			<tr>
 				<td>Email</td>
		   		<td><input type='text' name='email_new' /></td>
			</tr>
	 		<tr>
 				<td>Area Code</td>
	 			<td><input type='text' name='phoneAC_new' /></td>
		 	</tr>
 			<tr>
 				<td>Phone Number</td>
		 		<td><input type='text' name='phone_new' /></td>
 			</tr>
	 		<tr>
 				<td>Password</td>
	 			<td><input type='password' name='password_new' /></td>
		 	</tr>
 			<tr>
 				<td>Role ID</td>
		 		<td><input type='text' name='roleID_new' /></td>
 			</tr>
			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form_action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='person.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
