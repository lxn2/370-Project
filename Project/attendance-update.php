<html>
<head>
	<title>Attendance Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form-action'] ) ? $_POST['form-action'] : "";

	if($action == "update"){
		try{
			$sql = "update FP.ATTENDANCE set STUDENT = ?, CLASS = ?, ATTENDANCE_DATE = ?, ATTENDANCE_STATUS = ?, COMMENT = ?";
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['student_update'],
							$_POST['class_update'],
							$_POST['attendanceDate_update'],
							$_POST['attendanceStatus_update'],
							$_POST['comment_update']));
			echo "Record was updated."; 
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select STUDENT, CLASS, ATTENDANCE_DATE, ATTENDANCE_STATUS, COMMENT from FP.PERSON where ID = :ID";
     		$query = $con->prepare( $sql );
     		$query->bindParam ( ':ID', $_REQUEST['record_id'],PDO::PARAM_INT );  
     		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id = $row['ID'];
     		$class_current = $row['CLASS'];
     		$attendanceDate_current = $row['ATTENDANCE_DATE'];
     		$attendanceStatus_current = $row['ATTENDANCE_STATUS'];
     		$comment_current = $row['COMMENT'];
	}catch(PDOException $exception){ //to handle error
		echo "Error: " . $exception->getMessage();
	}
?>
 
<!--we have our html form here where new user information will be entered-->
 
	<form action='#' method='post' border='0'>
		<table class="imagetable">
			<tr>
             			<td>Student</td>
             			<td><input type='text' name='student_update' value='<?php echo $student_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Class</td>
             			<td><input type='text' name='class_update' value='<?php echo $class_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Attendance Date</td>
             			<td><input type='text' name='attendanceDate_update'  value='<?php echo $attendanceDate_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Attendance Status</td>
             			<td><input type='text' name='attendanceStatus_update'  value='<?php echo $attendanceStatus_current;  ?>' /></td>
         		</tr>
         		<tr>
             			<td>Comment</td>
             			<td><input type='text' name='comment_update'  value='<?php echo $comment_current;  ?>' /></td>
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