<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");

function pdo_connect(){
		
	try{
			$dbdriver = "mysql";	
			$hostname = "localhost";
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
?>