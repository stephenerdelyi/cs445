<?php
	require("db.php");
	
	$results = DB::query("SELECT * FROM phishies");
	
	foreach($results as $row) {
		?>
			<div class="ticker-item">
				<?php echo $row["username"]; ?>
			</div>
		<?php
	}
?>