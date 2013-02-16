<html>
<head>
	<title>Attendance Table - Update Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset( $_POST['form_action'] ) ? $_POST['form_action'] : "";

	if($action == "update"){
		try{
			$sql = "update FP.ATTENDANCE set ATTENDANCE_STATUS = ?, COMMENT = ? where STUDENT = ? and CLASS = ? and ATTENDANCE_DATE = ?";
			$query = $con->prepare($sql);
			$query->execute(array(	$_POST['attendanceStatus_update'],
							$_POST['comment_update'],
							$_POST['record_id_student'],
							$_POST['record_id_class'],
							$_POST['record_id_attendance_date']));
			echo "Record was updated."; 
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	} //end action update

	try {
		//prepare query
		$sql = "select STUDENT, CLASS, ATTENDANCE_DATE, ATTENDANCE_STATUS, COMMENT from FP.ATTENDANCE where STUDENT = :STUDENT and CLASS = :CLASS and ATTENDANCE_DATE = :ATTENDANCE_DATE";
     		$query = $con->prepare( $sql );
     		$query->bindParam ( ':STUDENT', $_REQUEST['record_id_student'],PDO::PARAM_INT );  
		$query->bindParam ( ':CLASS', $_REQUEST['record_id_class'],PDO::PARAM_INT );
		$query->bindParam ( ':ATTENDANCE_DATE', $_REQUEST['record_id_attendance_date'],PDO::PARAM_STR );
     		$query->execute();
		//store retrieved row to a variable
		$row = $query->fetch(PDO::FETCH_ASSOC);

		//values to fill up our form
		$id_student = $row['STUDENT'];
     		$id_class = $row['CLASS'];
     		$id_attendance_date = $row['ATTENDANCE_DATE'];
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
					<input type='hidden' name='record_id_student' value='<?php echo $id_student ?>' /> 
					<input type='hidden' name='record_id_class' value='<?php echo $id_class ?>' /> 
					<input type='hidden' name='record_id_attendance_date' value='<?php echo $id_attendance_date ?>' /> 
					<!--we will set the action to edit-->
					<input type='hidden' name='form_action' value='update' />
					<input type='submit' value='Edit' />
					<a href='attendance.php'>Back to index</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>