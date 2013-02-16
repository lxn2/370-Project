<html>
<head>
 	<title>Class Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into FP.CLASS (ROOM, GRADE_LEVEL_ID, TERM_ID, MAIN_TEACHER)
            values (:ROOM, :GRADE_LEVEL_ID, :TERM_ID, :MAIN_TEACHER)";
			$query = $con->prepare($sql);  
			$query->execute(array(	':ROOM'=>$_POST['room_update'],
							':GRADE_LEVEL_ID'=>$_POST['gradeLevelID_update'],
							':TERM_ID'=>$_POST['termID_update'], 
							':MAIN_TEACHER'=>$_POST['mainTeacher_update']));
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
 				<td><input type='text' name='room_update' /></td>
  			</tr>
 			<tr>
 				<td>Grade Level ID</td>
		 		<td><input type='text' name='gradeLevelID_update' /></td>
			</tr>
 			<tr>
 				<td>Term ID</td>
		   		<td><input type='text' name='termID_update' /></td>
			</tr>
	 		<tr>
 				<td>Main Teacher</td>
	 			<td><input type='text' name='mainTeacher_update' /></td>
		 	</tr>
			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form_action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='class.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
