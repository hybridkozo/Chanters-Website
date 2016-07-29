<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("loginmine.php");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta charset="utf-8">
<title>Σύλογος Ιεροψαλτών</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
		<div class="page-header">
		
			<h1>
				<img src="media/images/logo.png" class="img-rounded" alt="Σύλογος Ιεροψαλτών" width="150" height="150">
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
				<?php
				require_once("./include/dynamicmenu.php");
				?>
						<ul class="nav navbar-nav navbar-right">
							
							<li><a href="logout.php" >Γεια σου, <?= $fgmembersite->UserFullName(); echo " "; ?><span class="glyphicon glyphicon-log-out"></span> Αποσύνδεση</a>
							</li>
						</ul>
									</div>
							</div>
					</div>
			</nav>
	
		<div class="row">
			<div class="col-md-9">
			<?php
require_once("administrator/include/validation.php");

$administration->PresentArticles('news');
?>
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

</body>
</html>