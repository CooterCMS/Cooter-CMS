<h1>Welcome to the setup</h1>

<?php

$new_hostname = 'localhost';
$pdo_filename = 'application/config/pdo_db_connect.php';
$pdo_data = '<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

function pdo_connect(){
		
	try{
			$dbdriver = "mysql";	
			$hostname = "'.$new_hostname.'";
			$database = "cooter_cms";
			$username = "DC4FNw6yRa77mBXe";
			$password = "nw8cndLazYQmPUbf";
	
		//to connect
		$DB = new PDO($dbdriver.":host=".$hostname."; dbname=".$database, $username, $password);
		return $DB;
		
	}catch(PDOException $e) {
		echo "Please contact Admin: ".$e->getMessage();
	}
	
}
?>';

file_put_contents($pdo_filename, $pdo_data);

?>

<p>
	Lets begin by getting connected to your database.
	<form>
		<label for="hostname">Hostname:</label>
		<input type="text" name="hostname" value="" />
		<input type="submit" value="Submit" />
	</form>
</p>
