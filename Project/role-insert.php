<html>
<head>
 	<title>Role Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into FP.ROLE (NAME)
			 	values (:NAME)";
			$query = $con->prepare($sql);  
			$query->execute(array(	':NAME'=>$_POST['name_update']));
			echo "Record was saved.";
		}catch(PDOException $exception){ //to handle error
 	  		echo "Error: " . $exception->getMessage();}
	}  //end if create action
?>

<!--we have our html form here where user information will be entered-->

	<form action='#' method='post' border='0'>
		<table class="imagetable">
 			<tr>
 				<td>Name</td>
 				<td><input type='text' name='name_update' /></td>
  			</tr>
			<tr>
            			<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form_action' value='create' />
		  			<input type='submit' value='Save' />
  					<a href='role.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
