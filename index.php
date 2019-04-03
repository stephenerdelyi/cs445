<html>
	<head>
		<title>Go Phish</title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<?php
			if($_GET["error"]) {
				?>
					<h3>Error was caught</h3>
				<?php
			}
		?>
		<div class="container">
			<div class="content">
				<img class="fisherman" src="fishing.png"/>
				<h1>Go Phish</h1>
				<form>
					<input id="email-phish" type="text" name="email" placeholder="name@example.com"/>
					<button id="submit-phish" type="submit"><img src="arrow.png"/></button>
				</form>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus libero vel enim rhoncus, ut dapibus mi condimentum. Cras gravida augue at ligula egestas, non aliquam erat lacinia. Ut gravida maximus tincidunt. Duis vulputate tortor eros, ac volutpat erat luctus sed. Nulla cursus bibendum finibus. Donec vulputate est sed vulputate consequat. Quisque sollicitudin ligula vel tempus blandit. Fusce rhoncus est eros, et imperdiet diam rhoncus sit amet. Integer vel rutrum neque. Maecenas pretium.</p>
			</div>
			<div id="ticker" class="sidebar"></div>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		updateTicker();
		
		setInterval(function() {
			updateTicker();
		}, 2000);
		
		function sendMail(type) {
			$.ajax({
				url: "process/send.php?email=" + $("#email-phish")[0].value + "&type=" + type
			}).done(function() {
				//
			});
		}
		
		function updateTicker() {
			$.ajax({
				url: "process/ticker.php"
			}).done(function(value) {
				$("#ticker")[0].innerHTML = value;
			});
		}
		
		document.getElementById("submit-phish").addEventListener("click", function(e) {
			e.preventDefault();
			swal("What phish would you like to catch?", {
				buttons: {
					cancel: "Cancel",
					fb: {
						text: "Facebook",
						value: "fb"
					},
					tw: {
						text: "Twitter",
						value: "tw"
					},
					ins: {
						text: "Instagram",
						value: "ins"
					},
					unr: {
						text: "UNR",
						value: "unr"
					},
				}
			}).then((value) => {
				sendMail(value);
			});
		});
	</script>
</html>
