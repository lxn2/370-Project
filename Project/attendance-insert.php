<html>
<head>
 	<title>Attendance Table - Insert Record</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>	
<?php
 	//include database connection
 	include 'db_connect.php';
	
	$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";

	if($action=='create'){
 		try{  
			$sql = "insert into FP.ATTENDANCE (STUDENT, CLASS, ATTENDANCE_DATE, ATTENDANCE_STATUS, COMMENT)
			 	values (:STUDENT, :CLASS, :ATTENDANCE_DATE, :ATTENDANCE_STATUS, :COMMENT)";  
			$query = $con->prepare($sql);  
			$query->execute(array(	':STUDENT'=>$_POST['student_new'], 
							':CLASS'=>$_POST['class_new'], 
							':ATTENDANCE_DATE'=>$_POST['attendanceDate_new'],
							':ATTENDANCE_STATUS'=>$_POST['attendanceStatus_new'],
							':COMMENT'=>$_POST['comment_new']));
			echo "Record was saved.";
		}catch(PDOException $exception){ //to handle error
 	  		echo "Error: " . $exception->getMessage();}
	}  //end if create action
?>

<!--we have our html form here where user information will be entered-->

	<form action='#' method='post' border='0'>
		<table class="imagetable">
 			<tr>
 				<td>Student</td>
 				<td><input type='text' name='student_new' /></td>
  			</tr>
 			<tr>
 				<td>Class</td>
		 		<td><input type='text' name='class_new' /></td>
			</tr>
 			<tr>
 				<td>Attendance Date</td>
		   		<td><input type='text' name='attendanceDate_new' /></td>
			</tr>
	 		<tr>
 				<td>Attendance Status</td>
	 			<td><input type='text' name='attendanceStatus_new' /></td>
		 	</tr>
 			<tr>
 				<td>Comment</td>
		 		<td><input type='text' name='comment_new' /></td>
 			</tr>
			<tr>
  				<td colspan="2" style="text-align: center;">
 					<input type='hidden' name='form_action' value='create' />
			  		<input type='submit' value='Save' />
  					<a href='attendance.php'>Back to index</a>
 				</td>
			</tr>
		</table>
	</form>
</body>
</html>
