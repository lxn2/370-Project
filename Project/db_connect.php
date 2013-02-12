<?php
 
$config['db'] = array(	
	'host'		=> 'cssql.seattleu.edu',
	'username'	=> 'stu12',
	'password'	=> 'stu12',
	'dbname'	=> 'dbstu12'
);

try {  
$con = new PDO ('dblib:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password'] );

}catch(PDOException $exception){ //TO handle connection error
 
echo "Connection error: " . $exception->getMessage();
}

?>

