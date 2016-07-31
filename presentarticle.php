<?php
require_once("./include/membersite_config.php");
if(isset($_GET['username'])){
	$conn = mysqli_connect($fgmembersite->db_host, $fgmembersite->username, $fgmembersite->pwd,$fgmembersite->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			
			$user=$_GET['username'];
			$com=$_GET['comment'];
			$artid=$_GET['articleid'];
			$sql = "INSERT INTO comments (user, body, id_article) VALUES ('$user','$com','$artid')";
			$result = mysqli_query($conn, $sql);
			
			mysqli_close($conn);	
			
			$fgmembersite->RedirectToURL("presentarticle.php?id=$artid");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<?php 

if(isset($_GET['code']))
{
   if($fgmembersite->ConfirmUser())
   {
        $fgmembersite->RedirectToURL("index.php?action=login.php");
   }
}

?>

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
		<?php
			include("template/header.php");
			include("template/navbar.php");
		?>
			
		<div class="row">
			
		
<div class="col-md-9">
			<?php
require_once("administrator/include/validation.php");


if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php?action=login.php");
    exit;
}

$fgmembersite->PresentSingleArticle($_GET['id']);

?>
</div>
			<?php
		include("include/gadgets.php");	
		?>
			
		</div>
		<?php
			
			include("template/footer.php");
		?>
			

	</div>
</body>
</html>



