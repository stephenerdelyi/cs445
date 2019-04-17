<?php
	require("db.php");
	
	$emails = DB::query("SELECT * FROM emails ORDER BY id DESC");
	
	?>
	<div class="header"><p>Emails</p></div>
	<?php
	
	foreach($emails as $row) {
		?>
			<a href="javascript:openTestWindow('<?php echo $row["id"]; ?>');"><div class="ticker-item">
				<img src="envelope.png"/>
				<p><?php echo $row["email"]; ?></p>
			</div></a>
		<?php
	}
?>