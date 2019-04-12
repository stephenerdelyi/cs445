<?php
	require('db.php');
	
	$email = $_GET["email"];
	$type = $_GET["type"];
	$url = "";
	
	if($type == "unr") {
		$url = "unr-sso";
	}
	
	DB::insert('emails', array(
		'email' => $email,
		'type' => $type,
		'timestamp' => time()
	));
	
	$emailId = DB::insertId();
	echo $emailId;
			
	$subject = 'Phishie!';
	$message = 'Here is your phishie link:<br><a target="_blank" href="localhost:8888/cs445/' . $url . '/?emailId=' . $emailId . '">click me</a>';
	$headers = 'From: noreply@steveerdelyi.com';
	
	//mail($email,$subject,$message,$headers);
?>