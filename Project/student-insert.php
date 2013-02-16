<html>
<head>
 	<title>Student Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into FP.STUDENT (FNAME,LNAME,EMAIL,PHONE_AC,PHONE,CURRENT_CLASS,CASE_WORKER)
            values (:FNAME,:LNAME,:EMAIL,:PHONE_AC,:PHONE,:CURRENT_CLASS,:CASE_WORKER)";
			$query = $con->prepare($sql);  
			$query->execute(array(	':FNAME'=>$_POST['firstName_update'], 
							':LNAME'=>$_POST['lastName_update'], 
							':EMAIL'=>$_POST['email_update'], 
							':PHONE_AC'=>$_POST['phoneAC_update'],
							':PHONE'=>$_POST['phone_update'],
							':CURRENT_CLASS'=>$_POST['currentClass_update'],
                            			':CASE_WORKER'=>$_POST['caseWorker_update']));
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
 				<td><input type='text' name='firstName_update' /></td>
  			</tr>
 			<tr>
 				<td>Last Name</td>
		 		<td><input type='text' name='lastName_update' /></td>
			</tr>
 			<tr>
 				<td>Email</td>
		   		<td><input type='text' name='email_update' /></td>
			</tr>
	 		<tr>
 				<td>Area Code</td>
	 			<td><input type='text' name='phoneAC_update' /></td>
		 	</tr>
 			<tr>
 				<td>Phone Number</td>
		 		<td><input type='text' name='phone_update' /></td>
 			</tr>
	 		<tr>
 				<td>Current Class</td>
	 			<td><input type='text' name='currentClass_update' /></td>
		 	</tr>
 			<tr>
 				<td>Case Worker</td>
		 		<td><input type='text' name='caseWorker_update' /></td>
 			</tr>
			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form_action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='student.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
