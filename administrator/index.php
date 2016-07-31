<?PHP
require_once("./include/validation.php");

if(isset($_POST['submitted']))
{
   if($administration->validateForm())
   {
	   if($administration->CheckUser()){
	   $administration->RedirectToURL("admin.php");
	   }
   }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta charset="utf-8">
<title>Administration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="max-width:600px;margin: auto;">
	<div class="row">
		<div class="col-md-12">
			<form id='adminformlogin' class="form-horizontal" role="form" action='' method='post' accept-charset='UTF-8'>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				
				<h1>Chanters-Website</h1>
				
				<div class="form-group">
					<div class="control-label col-md-12">* Απαιτούμενα πεδία</div>
				</div>
				<div class="form-group">
					<div class="control-label col-md-12"><span class='error'><?php echo $administration->noUserError; ?></span></div>
				</div>
				<div class="form-group">
					<label for='username' class="control-label col-md-3">Όνομα Χρήστη*:</label>
					<div class="col-md-9">
						<input type='text' name='username' id='username' value="<?php echo $administration->username?>" class="form-control" maxlength="50" /></br>
						<span id='login_username_errorloc' class='error'><?php echo $administration->errorUsername; ?></span>
					</div>	
				</div>
				<div class="form-group">
					<label for='password' class="control-label col-md-3">Κωδικός*:</label>
					<div class="col-md-9">
						<input type='password' class="form-control" name='password' id='password' value="<?php echo $administration->password?>" maxlength="50" /><br/>
						<span id='login_password_errorloc' class='error'><?php echo $administration->errorPassword; ?></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<input type='submit' name='Submit' value='Είσοδος' class="btn btn-success btn-block" />
					</div>			
				</div>
				
				<h1>Administrator Page</h1>
				<p>© 2016 Σύλογος Ιεροψαλτών Αθηνών, designed by <a href="https://www.linkedin.com/in/ioannis-kozompolis-373406125">John Kozompolis</a> and George Emmanouil</p>
				
			</form>
		</div>
	</div>
	</div>
</div>
</body>
</html>