<html>
<head>
 	<title>Alert Table</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<script type='text/javascript'>

</script>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset($_GET['form_action']) ? $_GET['form_action']: "";

	//if the user clicked ok, run our delete query
	if($action=='delete'){
		try {
			$sql = "delete from FP.ALERT where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array( $_GET['record_id']));
			echo "<div>Record was deleted.</div>";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}

	$query =$con->query("select count(*) as NUM_RECORDS from FP.ALERT");
	$query = $query->fetch(PDO::FETCH_ASSOC);
	$num = $query['NUM_RECORDS'];
	
	//select all data
	$sql = "select STUDENT, CLASS, ALERT_DATE, ATT_CODE_ID from FP.ALERT";
	$query = $con->prepare( $sql );
	$query->execute();

	echo "<a href='person-insert.php'>Create New Record</a>";
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
				<th>Alert Date</th>
				<th>Attendance Code ID</th>
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
				<td>{$ALERT_DATE}</td>
				<td>{$ATT_CODE_ID}</td>
				<td>
					<a href='#' onclick='delete_record( {$ID} );'>Delete</a>
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