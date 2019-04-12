<?php
	include("process/db.php");
	
	$emailId = $_GET["emailId"];
	$url = "";
	
	$email = DB::queryOneField('email', "SELECT * FROM emails WHERE id=%s", $emailId);
	$type = DB::queryOneField('type', "SELECT * FROM emails WHERE id=%s", $emailId);	
	
	if($type == "unr") {
		$url = "unr-sso";
	}
	
	$message = 'Here is your phishie link:<br><a target="_blank" href="' . $url . '/?emailId=' . $emailId . '">click me</a>';

	echo "Would mail:<br><hr>";
	echo "Subject: Phishie!<br>";
	echo "To: " . $email . "<br>";
	echo "From: noreply@steveerdelyi.com<br>";
	echo "Message: " . $message . "<br><hr>";
	echo '<a href="javascript:window.close();">Close</a>';
?>