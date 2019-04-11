<html>
	<head>
		<title>Go Phish</title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<div class="container">
			<?php
				if(isset($_GET["error"])) {
					?>
						<h3>Error was caught</h3>
					<?php
				}
			?>
			<div class="content">
				<img class="fisherman" src="fishing.png"/>
				<h1>Go Phish</h1>
				<form>
					<input id="email-phish" type="text" name="email" placeholder="name@example.com"/>
					<button id="submit-phish" type="submit"><img src="arrow.png"/></button>
				</form>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus libero vel enim rhoncus, ut dapibus mi condimentum. Cras gravida augue at ligula egestas, non aliquam erat lacinia. Ut gravida maximus tincidunt. Duis vulputate tortor eros, ac volutpat erat luctus sed. Nulla cursus bibendum finibus. Donec vulputate est sed vulputate consequat. Quisque sollicitudin ligula vel tempus blandit. Fusce rhoncus est eros, et imperdiet diam rhoncus sit amet. Integer vel rutrum neque. Maecenas pretium.</p>
			</div>
			<div class="sidebar">
				<div id="phishie-ticker"></div>
				<div id="emails-ticker"></div>
			</div>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		updateTickers();
		
		setInterval(function() {
			updateTickers();
		}, 5000);
		
		function sendMail(type) {
			emailValue = $("#email-phish")[0].value;
			
			showLoading(emailValue, type);
			$.ajax({
				url: "process/send.php?email=" + emailValue + "&type=" + type
			}).done(function(data) {
				updateTickers();
				if(swal.getState().isOpen == true) {
					swal.close();
				}
				showSent(emailValue, type);
				openTestWindow(emailValue, type);
				$("#email-phish")[0].value = "";
			});
		}
		
		function openTestWindow(email, type) {
			window.open("test.php?email=" + email + "&type=" + type, "_blank", "toolbar=0,location=0,menubar=0,height=200px,width=350px");
		}
		
		function showEmailError(email) {
			retText = "";
			if(email == "") {
				retText = "Please enter an email to send a phish.";
			} else {
				retText = "The email \"" + email + "\" is invalid.";
			}
			
			swal({
				'title': 'Invalid Email',
	            'text': retText,
	            'icon': "error"
			});
		}
		
		function validEmail(email) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
			    return true;
			}
			
			return false;
		}
		
		function showLoading(email, type) {
			swal({
				'title': 'Sending...',
	            'text': 'Your ' + type + ' phishie is swimming to \n' + email,
	            'icon': "warning",
	            'closeOnEsc': false,
	            'closeOnClickOutside': false,
	            'buttons': false
			});
		}
				
		function showSent(email, type) {
			swal({
				'title': 'Sent',
	            'text': 'Your ' + type + ' phishie has been sent to \n' + email,
	            'icon': "success"
			});
		}
		
		function updateTickers() {
			$.ajax({
				url: "process/phishie-ticker.php"
			}).done(function(value) {
				$("#phishie-ticker")[0].innerHTML = value;
			});
			$.ajax({
				url: "process/emails-ticker.php"
			}).done(function(value) {
				$("#emails-ticker")[0].innerHTML = value;
			});
		}
		
		document.getElementById("submit-phish").addEventListener("click", function(e) {
			e.preventDefault();
			emailValue = $("#email-phish")[0].value;

			if(validEmail(emailValue)) {
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
			} else {
				showEmailError(emailValue);
			}
		});
	</script>
</html>
