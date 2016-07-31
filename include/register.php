	
<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
	   
        $fgmembersite->RedirectToURL("index.php?action=thankyou.php");
      
   }
}

?>	
	<div class="col-md-9">
			<h1> Εγγραφή </h1>
			<hr>
				<form id='register' class="form-horizontal" role="form" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
				
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<input type='hidden' name='register' id='register' value='1'/>
					<div class="form-group">
					<input type='hidden'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />
					<div class="control-label col-md-12">* Απαιτούμενα πεδία</div>
					
				</div>
				<div class="form-group">
				<div class="control-label col-md-9"><span class='error' style="color:red;"><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for='name' >Όνομα/Επώνυμο*: </label>
					<div class="col-md-9">
					<input type='text'class="form-control" name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
					<span id='register_name_errorloc' class='error' style="color:red;"></span>
					</div>
				</div>
				<div class='container, form-group'>
					<label class="control-label col-md-3" for='email' >Διεύθυνση Email*:</label>
					<div class="col-md-9">
					<input type='text' class="form-control" name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
					<span id='register_email_errorloc' class='error'style="color:red;" ></span>
					</div>
				</div>
				<div class='form-group'>
					<label class="control-label col-md-3" for='username' >Όνομα Χρήστη*:</label>
					<div class="col-md-9">
					<input type='text' class="form-control" name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
					<span id='register_username_errorloc' class='error' style="color:red;" ></span>
					</div>
				</div>
				<div class='form-group' style='height:80px;'>
					<label class="control-label col-md-3" for='password' >Κωδικός*:</label>
					<div class="col-md-9">
					<div class='pwdwidgetdiv' id='thepwddiv' ></div>
					<noscript>
					<input type='password' class="form-control" name='password' id='password' maxlength="50" />
					</noscript>    
					<div id='register_password_errorloc' class='error' style='clear:both;color:red;'></div>
					</div>
				</div>

				<div class='form-group'>
					<div class="col-md-12">
					<input type='submit'  name='Submit' class="btn btn-success btn-block" value='Εγγραφή' />
					</div>
				</div>
			</form>
			<hr>
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