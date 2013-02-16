<html>
<head>
 	<title>Attendance Table</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<script type='text/javascript'>
function delete_record(id_student, id_class, id_alert_date){
	var answer = confirm('Are you sure?');
	if(answer){ //if user clicked ok
		//redirect to url with action as delete and id to the record to be deleted
		window.location = 'attendance.php?form_action=delete&record_id_student=' + id_student + '&record_id_class=' + id_class + '&record_id_alert_date=' + id_alert_date;
	} 
}
</script>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset($_GET['form_action']) ? $_GET['form_action']: "";

	//if the user clicked ok, run our delete query
	if($action=='delete'){
		try {
			$sql = "delete from FP.ATTENDANCE where STUDENT = ? and CLASS = ? and ATTENDANCE_DATE = ?";
			$query = $con->prepare($sql);
			$query->execute(array( 	$_GET['record_id_student'],
							$_GET['record_id_class'],
							$_GET['record_id_attendance_date']));
			echo "<div>Record was deleted.</div>";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}

	$query =$con->query("select count(*) as NUM_RECORDS from FP.ATTENDANCE");
	$query = $query->fetch(PDO::FETCH_ASSOC);
	$num = $query['NUM_RECORDS'];
	
	//select all data
	$sql = "select STUDENT, CLASS, ATTENDANCE_DATE, ATTENDANCE_STATUS, COMMENT from FP.ATTENDANCE";
	$query = $con->prepare( $sql );
	$query->execute();

	echo "<a href='attendance-insert.php'>Create New Record</a>";
	//create style sheet string to use in <table> tag below
	$classTag1 = "imagetable";
	$classTag2 = "class=" . $classTag1;
	//if records exist, build table
	if($num>0){
 		echo "
		<table $classTag2>
			<tr>
				<th>Student</th>
				<th>Class</th>
				<th>Attendance Date</th>
				<th>Attendance Status</th>
				<th>Comment</th>
				<th>Action</th>
			</tr>
		";
 
		//retrieve table contents, index=>value pairs converted to columnName=>data
		while ($row = $query->fetch(PDO::FETCH_ASSOC)){

	 		//convert $row['FNAME'] to $FNAME
			extract($row);
 
			//creating new table row per record
			echo "
			<tr>
				<td>{$STUDENT}</td>
				<td>{$CLASS}</td>
				<td>{$ATTENDANCE_DATE}</td>
				<td>{$ATTENDANCE_STATUS}</td>
				<td>{$COMMENT}</td>
				<td>
					<a href='attendance-update.php?record_id_student={$STUDENT}&record_id_class={$CLASS}&record_id_attendance_date={$ATTENDANCE_DATE}'>Edit</a>
					 / 
					<a href='#' onclick='delete_record( {$STUDENT}, {$CLASS}, \"{$ATTENDANCE_DATE}\" );'>Delete</a>
				</td>
			</tr>
			";
 		}
 		echo "
		</table>
		";
 	}else{ //if no records found
 		echo "No records found.";
	}
?>
</body>
</html>