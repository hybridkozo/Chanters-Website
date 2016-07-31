<?PHP
require_once("./include/membersite_config.php");

$emailsent = false;
if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
        $fgmembersite->RedirectToURL("index.php?action=reset_password_link.php");
        exit;
   }
}

?>
<div class="col-md-9">
			<h1> Επαναφορά κωδικού </h1>
			<hr>
			<form id='resetreg' class="form-horizontal" role="form" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<input type='hidden' name='resetpassword' id='resetpassword' value='1'/>
				<div class="form-group">
					<div class="control-label col-md-12">* Απαιτούμενα πεδία</div>
				</div>
				<div class="form-group">
					<div class="control-label col-md-12"><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				</div>
				<div class="form-group">
					<label for='username' class="control-label col-md-3">Email*:</label>
					<div class="col-md-9">
						<input type='text' name='email' id='email' class="form-control" value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
						<span id='resetreq_email_errorloc' class='error'></span>
					</div>	
				</div>
				<div class="form-group">
					<div class="col-md-12">
						Ένας σύνδεσμος θα αποσταλεί στο Email σας για να επαναφέρετε τον λογαριασμό σας με καινούριο κωδικό.
					</div>			
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<input type='submit' name='Submit' value='Αποστολή κωδικού' class="btn btn-success btn-block" />
					</div>			
				</div>
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->
			<script type='text/javascript'>
				// <![CDATA[

				var frmvalidator  = new Validator("resetreq");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();

				frmvalidator.addValidation("email","req","Παρακαλώ γράψτε το email που κάνατε εγγραφή");
				frmvalidator.addValidation("email","email","Παρακαλώ γράψτε το email που κάνατε εγγραφή");

				// ]]>
			</script>
			</div>