
<?PHP
require_once("./include/adminfunctions.php");
$administration=new administration();
$administration->InitDB(/*hostname*/'unipichanters.czbrbzfqqipe.eu-central-1.rds.amazonaws.com',
                      /*username*/'unipiAdmin0',
                      /*password*/'unipialepis8never',
                      /*database name*/'chanters');
if(!$administration->CheckLogin())
{
    $administration->RedirectToURL("index.php");
    exit;
}
if (isset($_GET['id']))
    {
        $administration->ChangePrivileges($_GET['id']);
		$_GET['id']=null;
		$administration->RedirectToURL("admin.php");
		
    }
	if (isset($_GET['id_del']))
    {
        $administration->DeleteUser($_GET['id_del']);
		$_GET['id_del']=null;
		$administration->RedirectToURL("admin.php");
		
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
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
	<div class="container">
	   <?php
	   include("template/header.php");
	   ?>
		<div class="row">
			<div class="col-md-3">
			<?php
			include("template/navmenu.php");
			?>
			</div>
			
			<div class="col-md-9">
			<h4> Main Page </h4>
			<hr>
			<?php 
			
				if (!empty($_GET['action'])) { 
				
				$action = $_GET['action'];  
				$action = basename($action);  

				include("include/$action");  
				} else {
				include("include/users.php");
					
				}
			?>
			</div>
		</div>
		<?php
	   include("template/footer.php");
	   ?>
	
	</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
</body>
</html>