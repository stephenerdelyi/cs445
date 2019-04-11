<?php
	$email = $_GET["email"];
	$type = $_GET["type"];
	$url = "";
	
	if($type == "unr") {
		$url = "unr-sso";
	}
	
	$message = 'Here is your phishie link:<br><a target="_blank" href="localhost:8888/cs445/' . $url . '/?emailId=' . $emailId . '">click me</a>';

	echo "Would mail:<br><hr>";
	echo "Subject: Phishie!<br>";
	echo "To: " . $email . "<br>";
	echo "From: noreply@steveerdelyi.com<br>";
	echo "Message: " . $message . "<br><hr>";
	echo '<a href="javascript:window.close();">Close</a>';
?>