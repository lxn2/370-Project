<html>
<head>
 	<title>Student Table</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<script type='text/javascript'>
function delete_record(id){
	var answer = confirm('Are you sure?');
	if(answer){ //if user clicked ok
		//redirect to url with action as delete and id to the record to be deleted
		window.location = 'student.php?form_action=delete&record_id=' + id;
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
			$sql = "delete from FP.STUDENT where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array( $_GET['record_id']));
			echo "<div>Record was deleted.</div>";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}

    $query =$con->query("select count(*) as NUM_RECORDS from FP.STUDENT");
    $query = $query->fetch(PDO::FETCH_ASSOC);
    $num = $query['NUM_RECORDS']
	
	//select all data
	$sql = "select ID, FNAME, LNAME, EMAIL, PHONE_AC, PHONE, CURRENT_CLASS, CASE_WORKER from FP.STUDENT";
	$query = $con->prepare( $sql );
	$query->execute();

	echo "<a href='student-insert.php'>Create New Record</a>";
	//create style sheet string to use in <table> tag below
	$classTag1 = "imagetable";
	$classTag2 = "class=" . $classTag1;
	//if records exist, build table
	if($num>0){
 		echo "
		<table $classTag2>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Area Code</th>
				<th>Phone Number</th>
				<th>Current Class</th>
                <th>Case Worker</th>
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
				<td>{$ID}</td>
				<td>{$FNAME}</td>
				<td>{$LNAME}</td>
				<td>{$EMAIL}</td>
				<td>{$PHONE_AC}</td>
				<td>{$PHONE}</td>
				<td>{$CURRENT_CLASS}</td>
                <td>{$CASE_WORKER}</td>
				<td>
					<a href='student-update.php?record_id={$ID}'>Edit</a>
					 / 
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