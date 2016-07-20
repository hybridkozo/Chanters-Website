<?PHP
require_once("./include/membersite_config.php");

if(isset($_GET['code']))
{
   if($fgmembersite->ConfirmUser())
   {
        $fgmembersite->RedirectToURL("thank-you-regd.html");
   }
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
  
  <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
  <script src="scripts/pwdwidget.js" type="text/javascript"></script> 
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
									
				<?php
				require_once("./include/dynamicmenu.php");
			?>
						
						<ul class="nav navbar-nav navbar-right">
							<li><a href="register.php" ><span class="glyphicon glyphicon-user"></span> Εγγραφή</a>								
							</li>
							
							<li><a href="#" ><span class="glyphicon glyphicon-log-in"></span> Είσοδος</a>
							</li>
						</ul>
									</div>
							</div>
					</div>
			</nav>
		<div id="articles" class="row">
			<div class="col-md-9">
			<h2>Επιβεβαίωση εγγραφής</h2>
<p>
Παρακαλώ γράψτε τον κωδικό εγγραφής παρακάτω.
</p>
			<hr>
				<form id='confirm' class="form-horizontal" role="form" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='get' accept-charset='UTF-8'>
					<div class="form-group">
					<div class="control-label col-md-12">* Απαιτούμενα πεδία</div>
					
				</div>
				<div class="form-group">
				<div class="control-label col-md-9"><span class='error' style="color:red;"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for='code' >Κωδικός επιβεβαίωσης*: </label>
					<div class="col-md-9">
					<input type='text'class="form-control" name='code' id='code'  maxlength="50" /><br/>
					<span id='register_code_errorloc' class='error'></span>
					</div>
				</div>
				<div class='container, form-group'>
					<div class="col-md-12">
					<input type='submit'class="btn btn-success btn-block"  name='Submit' value='Επιβεβαίωση' />
					</div>
				</div>
			</form>
				<script type='text/javascript'>
					// <![CDATA[

					var frmvalidator  = new Validator("confirm");
					frmvalidator.EnableOnPageErrorDisplay();
					frmvalidator.EnableMsgsTogether();
					frmvalidator.addValidation("code","req","Παρακαλώ γράψτε τον κωδικό επιβεβαίωσης");

					// ]]>
				</script>
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
<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Παρακαλώ δώστε ένα όνομα");
    frmvalidator.addValidation("email","req","Παρακαλώ δώστε ένα Email");
    frmvalidator.addValidation("email","email","Παρακαλώ δώστε την σωστή διεύθυνση Email");
    frmvalidator.addValidation("username","req","Παρακαλώ δώστε ένα όνομα χρήστη");
    frmvalidator.addValidation("password","req","Παρακαλώ δώστε ένα κωδικό");
// ]]>
</script>

</body>
</html>