<?php
	include("process/db.php");
	
	function humanTiming ($time) {
	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );
	
	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }
	}
	
	$emailId = $_GET["emailId"];
	$url = "";
	
	$subject = "You have a new notification.";
	$fromEmail = "noreply@unr.edu";
	$email = DB::queryOneField('email', "SELECT * FROM emails WHERE id=%s", $emailId);
	$type = DB::queryOneField('type', "SELECT * FROM emails WHERE id=%s", $emailId);	
	$timestamp = DB::queryOneField('timestamp', "SELECT * FROM emails WHERE id=%s", $emailId);
	
	if($type == "unr") {
		$url = "unr-sso";
	}
	
	$message = 'Here is your phishie link:<br><a target="_blank" href="unr-sso/?emailId=' . $emailId . '">click me</a>';

	echo '';
?>
<html>
	<head>
		<title>Mail Emulator: <?php echo $subject; ?></title>
		<style>
			body {
				font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
			}
		</style>
	</head>
	<body>
		<a href="javascript:window.close();">Close</a>
		<h1><?php echo $subject; ?></h1>
		<h2>Received: <?php echo humanTiming($timestamp); ?> ago</h2>
		<h3>To: <span><?php echo $email; ?></span></h3>
		<h3>From: <span><?php echo $fromEmail; ?></span></h3>
		<hr>
		<?php echo $message; ?>
	</body>
</html>
