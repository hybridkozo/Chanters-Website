<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Σύλογος Ιεροψαλτών</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
    <div class="container">
		<div class="page-header">
		
			<h1>
				<img src="media/images/logo.gif" class="img-rounded" alt="Σύλογος Ιεροψαλτών" width="100" height="120">
				Σύλογος Ιεροψαλτών Αθηνών
			</h1>
			<p>Ο Σύλογος Ιεροψαλτών Αθηνών είναι δίπλα σας από το 1924.</p>
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>			
					</div>
					<div class="collapse navbar-collapse"  id="myNavbar">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Αρχική</a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ο Σύλογος μας <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Η Ιστορία μας</a></li>
									<li><a href="#">Κανονισμός Ιεροψαλτών</a></li>
									<li><a href="#">Δοιηκητικό Συμβούλιο</a></li>
								</ul>
							</li>
							<li><a href="#">Τα νέα μας</a></li>
							<li><a href="#">Επικοινωνία</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Εγγραφή</a>
						<!-- Modal -->
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
    
							<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Εγγραφή Χρήστη</h4>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" role="form">
													<div class="form-group">
														<label class="control-label col-sm-2" for="name">Όνομα:</label>
															<div class="col-sm-10">
																<input type="text" class="form-control" id="regName" placeholder="π.χ. Ιωάννης">
															</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-2" for="surname">Επώνυμο:</label>
															<div class="col-sm-10">
																<input type="text" class="form-control" id="regSurname" placeholder="π.χ. Κοζομπόλης">
															</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-2" for="telephone">Τηλέφωνο:</label>
															<div class="col-sm-10">
																<input type="tel" class="form-control" id="regTelephone" placeholder="π.χ. 6971903121">
															</div>
													</div>	
													<div class="form-group">
														<label class="control-label col-sm-2" for="email">E-mail:</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="regEmail" placeholder="π.χ. g.kozompolis@gmail.com">
															</div>
													</div>	
													<div class="form-group">
														<label class="control-label col-sm-2" for="password">Κωδικός:</label>
															<div class="col-sm-10">
																<input type="password" class="form-control" maxlength="8" id="regPasswod" placeholder="π.χ. 1990!asQ">
															</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-2" for="password">Re-Type:</label>
															<div class="col-sm-10">
																<input type="password" class="form-control" maxlength="8" id="regPassword" placeholder="π.χ. 1990!asQ">
															</div>
													</div>
											</div>
											<div class="modal-footer">
												<div class="form-group" >
													<button type="button" class="btn btn-success">Εγγραφή</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Ακύρωση</button>
												</div>
											</div>
										</div>
      
									</div>
								</div>
							</li>
							<li><a href="#" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-log-in"></span> Είσοδος</a>
						<!-- Modal -->
								<div class="modal fade" id="myModal2" role="dialog">
									<div class="modal-dialog">
    
							<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Είσοδος Χρήστη</h4>
											</div>
											<div class="modal-body" style="height:200px;">
												<form class="form-horizontal" role="form">
													<div class="form-group">
														<label class="control-label col-sm-2" for="email" style="margin:5px;">E-mail:</label>
															<div class="col-sm-10">
																<input type="email" class="form-control" id="logEmail" placeholder="π.χ. g.kozompolis@gmail.com" style="margin:5px;">
															</div>
													</div>	
													<div class="form-group">
														<label class="control-label col-sm-2" for="password" style="margin:5px;">Κωδικός:</label>
															<div class="col-sm-10">
																<input type="password" class="form-control" maxlength="8" id="logPasswod" placeholder="π.χ. 1990!asQ" style="margin:5px;">
															</div>
													</div>
											</div>
											<div class="modal-footer">
												<div class="form-group" >
													<button type="button" class="btn btn-success">Είσοδος</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Ακύρωση</button>
												</div>
											</div>
										</div>
      
									</div>
								</div>
							</li>
						</ul>
									</div>
							</div>
					</div>
			</nav>
			<?php
				$dbhost = 'localhost:3306';
				$dbuser = 'john';
				$dbpass = 'giannis';
				$conn = mysql_connect($dbhost, $dbuser, $dbpass);
				if(!$conn){
					die('could not connect: ' . mysql_error());
				}
				echo 'Connected to the database successfully';
				mysql_close($conn);
				
			?>
		<div class="row">
			<div class="col-md-9">
			<h1> articles </h1>
			<hr>
			</div>
			
			<div class="col-md-3">
			<h1> Gagets </h1>
			<hr>
			</div>
		</div>
		<div class="footer" style="background-color:#1a1a1a;color:#cccccc;border-radius: 5px;">
		<div class="row">
			<div class="col-md-4">
			<h3> Site Map </h3>
			<hr>
				<ul >
					<li > Αρχική</li>
					<li > Ο Σύλογος μας</li> 
					<li > Τα νέα μας</li> 
					<li > Επικοινωνία</li> 
				</ul>
			<hr>	
			</div>
			<div class="col-md-4">
			<h3> Social Media </h3>
			<hr>
				<ul >
					<li > Facebook</li>
					<li > Twitter</li> 
					<li > Youtube</li> 
					<li > Google+</li> 
				</ul>
				<hr>
			</div>
			<div class="col-md-4">
			<h3> Επικοινωνία </h3>
			<hr>
				<p><span class="glyphicon glyphicon-home"></span> Πραξιτέλους 236, Πειραιάς, Τ.Κ. 18633</p>
				<p> <span class="glyphicons glyphicons-iphone"></span>+306971903121</p>
				<p> <span class="glyphicons glyphicons-email"></span> g.kozompolis@gmail.com</p>
			<hr>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				
			<p style="text-align:center;">© 2016 Σύλογος Ιεροψαλτών Αθηνών, designed by John Kozompolis and George Emmanouil</p>
			
			</div>
		</div>
		</div>
			</div>
		</div>
	</div>
</body>
</html