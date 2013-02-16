<html>
<head>
	<title>Class Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form_action'] ) ? $_POST['form_action'] : "";

	if($action == "update"){
		try{
			$sql = "update FP.CLASS set ROOM = ?, GRADE_LEVEL_ID = ?, TERM_ID = ?, MAIN_TEACHER = ?  where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['room_update'],
							$_POST['gradeLevelID_update'],
							$_POST['termID_update'],
							$_POST['mainTeacher_update'],
							$_POST['record_id']));
			echo "Record was updated.";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select ID, ROOM, GRADE_LEVEL_ID, TERM_ID, MAIN_TEACHER from FP.CLASS where ID =:ID";
		$query = $con->prepare( $sql );
		$query->bindParam ( ':ID', $_REQUEST['record_id'],PDO::PARAM_INT );  
		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
		$room_current = $row['ROOM'];
		$gradeLevelID_current = $row['GRADE_LEVEL_ID'];
		$termID_current = $row['TERM_ID'];
		$mainTeacher_current = $row['MAIN_TEACHER'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
				<td>Room</td>
				<td><input type='text' name='room_update' value='<?php echo $room_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Grade Level ID</td>
				<td><input type='text' name='gradeLevelID_update' value='<?php echo $gradeLevelID_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Term ID</td>
				<td><input type='text' name='termID_update'  value='<?php echo $termID_current;  ?>' /></td>
			</tr>
			<tr>
				<td>Main Teacher</td>
				<td><input type='text' name='mainTeacher_update'  value='<?php echo $mainTeacher_current;  ?>' /></td>
			</tr>
            <tr>
				<td colspan="2" style="text-align: center;">
					<!--so that we could identify what record is to be updated-->
					<input type='hidden' name='record_id' value='<?php echo $id ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form_action' value='update' />
					<input type='submit' value='Edit' />
					<a href='class.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>