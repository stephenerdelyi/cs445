<?php
	require("db.php");
	
	$phishies = DB::query("SELECT * FROM emails ORDER BY id DESC");
	
	foreach($phishies as $row) {
		?>
			<div class="ticker-item">
				<?php echo $row["email"]; ?>
			</div>
		<?php
	}
?>