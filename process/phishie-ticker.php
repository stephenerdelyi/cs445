<?php
	require("db.php");
	
	$phishies = DB::query("SELECT * FROM phishies");
	
	foreach($phishies as $row) {
		?>
			<div class="ticker-item">
				<?php echo $row["username"]; ?>
			</div>
		<?php
	}
?>