<html>
<head>
 	<title>Class Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form-action']) ? $_POST['form-action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into CLASS (ROOM, GRADE_LEVEL_ID, TERM_ID, MAIN_TEACHER)
            values (:ROOM, :GRADE_LEVEL_ID, :TERM_ID, :MAIN_TEACHER)";
			$query = $con->prepare($sql);  
			$query->execute(array(	':ROOM'=>$_POST['room-new'], 
							':GRADE_LEVEL_ID'=>$_POST['gradeLevelID-new'], 
							':TERM_ID'=>$_POST['termID-new'], 
							':MAIN_TEACHER'=>$_POST['mainTeacher-new']));
			echo "Record was saved.";
		}catch(PDOException $exception){ //to handle error
 	  		echo "Error: " . $exception->getMessage();}
	}  //end if create action
?>

<!--we have our html form here where user information will be entered-->

	<form action='#' method='post' border='0'>
		<table class="imagetable">
 			<tr>
 				<td>Room</td>
 				<td><input type='text' name='room-new' /></td>
  			</tr>
 			<tr>
 				<td>Grade Level ID</td>
		 		<td><input type='text' name='gradeLevelID-new' /></td>
			</tr>
 			<tr>
 				<td>Term ID</td>
		   		<td><input type='text' name='termID-new' /></td>
			</tr>
	 		<tr>
 				<td>Main Teacher</td>
	 			<td><input type='text' name='mainTeacher-new' /></td>
		 	</tr>
			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form-action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='class.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
