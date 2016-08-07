
<?php 
require_once("./include/membersite_config.php");
if(isset($_GET['code']))
{
   if($fgmembersite->ConfirmUser())
   {
        $fgmembersite->RedirectToURL("index.php?action=login.php");
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta charset="utf-8">
<title>Σύλογος Ιεροψαλτών</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style/custom.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
  <script src="scripts/pwdwidget.js" type="text/javascript"></script> 
  <script>
$(document).ready(function() {
	$('#myCarousel').carousel({
		interval:   4000
	});
});
</script>
<script>
    $(document).ready(function() {
    if (window.location.href.indexOf("history") > -1) {
        $("#Ο Σύλογος").attr('class', 'dropdown active');
	}});
​
</script>

<script>
$(document).ready(function(){
    $("#zoom").mouseenter(function(){
        
    });
	$("#zoom2").mouseenter(function(){
       
    });
	$("#zoom3").mouseenter(function(){
        
    });
	$("#zoom4").mouseenter(function(){
        
    });
});
</script>



  
  
</head>
<body style="background-color: #f2f2f2">
    <div class="container">
		<?php
			include("template/header.php");
			include("template/navbar.php");
		?>
			
		<div class="row">
			
		<?php
		
		    if(isset($_POST['register'])){
				
				
				
				include("include/register.php");
				
			}
			else if(isset($_POST['login'])){
				
				
				
				include("include/login.php");
				
			}
			
			else if(isset($_POST['resetpassword'])){
				
				
				
				include("include/reset_password.php");
				
			}
			else {
		
					if (!empty($_GET['action'])) { 
				
						$action = $_GET['action'];  
						$action = basename($action);  

						include("include/$action");  
						} else {
						include("include/homepage.php");
					
						}
			}
			include("include/gadgets.php");
		?>
			
			
			
		</div>
		<?php
			include("template/footer.php");
		?>
			

	</div>
	
</body>
</html>