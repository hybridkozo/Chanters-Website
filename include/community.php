<?php
	
	if(isset($_POST['submitted'])){
		if ($fgmembersite->ValidateCommunitySubmission()){
			if ($fgmembersite->SendCommunityEmail($_POST['email'], $_POST['name'], $_POST['message'])){
				$fgmembersite->RedirectToURL("index.php?action=sendemailok.php");
			}
		}
	}
	
	
	if($fgmembersite->CheckLogin()){
    $name=$fgmembersite->UserFullName();
	$email=$fgmembersite->UserEmail();
	}else{
		$name="";
		$email="";
	}
	
	?>
	
	<div class="col-md-8">
	<h1>Φόρμα Επικοινωνίας</h1>
	<form id="community" class="form-horizontal" role="form" method="POST" action="index.php?action=community.php" accept-charset='UTF-8'>
    <input type='hidden' name='submitted' id='submitted' value='1'/>
	
	<div class="form-group">
					<div class="control-label col-md-12">* Απαιτούμενα πεδία</div>
					
				</div>
				
				<div class="form-group">
				<div class="control-label col-md-9"><span class="error" style="color:red;"><?php echo $fgmembersite->validationerror; ?></span></div>
				</div>
				<div class="form-group">
    <label class="control-label col-sm-2" for="name">Name*:</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $name; ?>" class="form-control" name="name" id="name">
	  <span id="community_name_errorloc" class="error" style="color:red;" ></span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email*:</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $email; ?>" class="form-control" name="email" id="email">
	  <span id="community_email_errorloc" class="error" style="color:red;" ></span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Message">Message*:</label>
    <div class="col-sm-10"> 
      <textarea class="form-control" id="message" name="message"></textarea>
	  <span id="community_message_errorloc" class="error" style="color:red;" ></span>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </div>
</form>


<hr>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3146.7220565532334!2d23.643384622063127!3d37.936923191696685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bbddfc30567f%3A0xa4aaeda352402aba!2zzqDPgc6xzr7Ouc-Ezq3Ou86_z4XPgiAyMzYsIM6gzrXOuc-BzrHOuc6sz4IgMTg1IDM2!5e0!3m2!1sel!2sgr!4v1470168802623" width="750" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
<hr>
</div>
<script type='text/javascript'>
			// <![CDATA[

			var frmvalidator  = new Validator("community");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();

			frmvalidator.addValidation("name","req"	,"Παρακαλω δώστε ένα όνομα");
    
			frmvalidator.addValidation("email","req","Παρακαλώ δώστε ένα email");
			frmvalidator.addValidation("email","email","Παρακαλώ δώστε ένα σωστό λογαριασμό email");
			frmvalidator.addValidation("message","req","Παρακαλώ γράψτε το ένα μήνυμα");

			// ]]>
			</script>
		


