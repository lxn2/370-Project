<html>
<head>
 	<title>Log Table</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<script type='text/javascript'>
function delete_record(id_student, id_class, id_log_date){
	var answer = confirm('Are you sure?');
	if(answer){ //if user clicked ok
		//redirect to url with action as delete and id to the record to be deleted
		window.location = 'log.php?form_action=delete&record_id_student=' + id_student + '&record_id_class=' + id_class + '&record_id_log_date=' + id_log_date;
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
			$sql = "delete from FP.LOG where STUDENT = ? and CLASS = ? and LOG_DATE = ?";
			$query = $con->prepare($sql);
			$query->execute(array( 	$_GET['record_id_student'],
							$_GET['record_id_class'],
							$_GET['record_id_log_date']));
			echo "<div>Record was deleted.</div>";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}

	$query =$con->query("select count(*) as NUM_RECORDS from FP.LOG");
	$query = $query->fetch(PDO::FETCH_ASSOC);
	$num = $query['NUM_RECORDS'];
	
	//select all data
	$sql = "select STUDENT, CLASS, LOG_DATE, OLD_STATUS, NEW_STATUS, ID_OF_UPDATER from FP.LOG";
	$query = $con->prepare( $sql );
	$query->execute();

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
				<th>Log Date</th>
				<th>Old Status</th>
				<th>New Status</th>
				<th>ID of Updater</th>
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
				<td>{$LOG_DATE}</td>
				<td>{$OLD_STATUS}</td>
				<td>{$NEW_STATUS}</td>
				<td>{$ID_OF_UPDATER}</td>
				<td>
					<a href='#' onclick='delete_record( {$STUDENT}, {$CLASS}, \"{$LOG_DATE}\" );'>Delete</a>
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