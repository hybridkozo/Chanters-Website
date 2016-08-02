<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("index.php");
   }
}

?>
	<div class="col-md-9">
			<h1> Είσοδος Χρήστη </h1>
			<hr>
			<form id='login' class="form-horizontal" role="form" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<input type='hidden' name='login' id='login' value='1'/>
				<div class="form-group">
					<div class="control-label col-md-12">* Απαιτούμενα πεδία</div>
				</div>
				<div class="form-group">
					<div class="control-label col-md-12"><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				</div>
				<div class="form-group">
					<label for='username' class="control-label col-md-3">Όνομα Χρήστη*:</label>
					<div class="col-md-9">
						<input type='text' name='username' id='username' class="form-control" value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
						<span id='login_username_errorloc' class='error' style="color:red;"></span>
					</div>	
				</div>
				<div class="form-group">
					<label for='password' class="control-label col-md-3">Κωδικός*:</label>
					<div class="col-md-9">
						<input type='password' class="form-control" name='password' id='password' maxlength="50" /><br/>
						<span id='login_password_errorloc' class='error' style="color:red;"></span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<input type='submit' name='Submit' value='Είσοδος' class="btn btn-success btn-block" />
					</div>			
				</div>
				<div class="form-group">
					<div class='col-md-12'><a href='index.php?action=reset_password.php'>Ξέχασες τον κωδικό σου;</a></div>
				</div>	
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[

			var frmvalidator  = new Validator("login");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();

			frmvalidator.addValidation("username","req"	,"Παρακαλώ δώστε ένα όνομα χρήστη");
    
			frmvalidator.addValidation("password","req","Παρακαλώ δώστε τον κωδικό σας");

			// ]]>
			</script>
			</div>