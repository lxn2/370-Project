<html>
<head>
 	<title>Role Tutorial</title>
	<link rel="stylesheet" type="text/css" href="db.css" />
</head>
<body>
<script type='text/javascript'>
function delete_record(id){
	var answer = confirm('Are you sure?');
	if(answer){ //if user clicked ok
		//redirect to url with action as delete and id to the record to be deleted
		window.location = 'role.php?form-action=delete&record-id=' + id;
	} 
}
</script>
<?php
	//include database connection
	include 'db_connect.php';

	$action = isset($_GET['form-action']) ? $_GET['form-action']: "";

	//if the user clicked ok, run our delete query
	if($action=='delete'){
		try {
			$sql = "delete from ROLE where ID = ?";
			$query = $con->prepare($sql);
			$query->execute(array( $_GET['record-id']));
			echo "<div>Record was deleted.</div>";
		}catch(PDOException $exception){ //to handle error
			echo "Error: " . $exception->getMessage();
		}
	}

	$num =$con->query("select count(*) from ROLE");
	
	//select all data
	$sql = "select ID, NAME from ROLE";
	$query = $con->prepare( $sql );
	$query->execute();

	echo "<a href='role-insert.php'>Create New Record</a>";
	//create style sheet string to use in <table> tag below
	$classTag1 = "imagetable";
	$classTag2 = "class=" . $classTag1;
	//if records exist, build table
	if($num>0){
 		echo "
		<table $class-tag>
			<tr>
				<th>ID</th>
				<th>Name</th>
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
				<td>{$NAME}</td>
				<td>
					<a href='role-update.php?record-id={$ID}'>Edit</a>
					 / 
					<a href='#' onclick='delete_role( {$ID} );'>Delete</a>
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