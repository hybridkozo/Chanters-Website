<?PHP
require_once("./include/adminfunctions.php");
$administration=new administration();
if(!$administration->CheckLogin())
{
    $administration->RedirectToURL("index.php");
    exit;
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
	<div class="container">
	<div class="page-header" style="background-color:#1a1a1a;color:#cccccc;border-radius: 5px;">
		<h1 style="text-align:center;"> Chanters-Website</h1>
		<h3 style="text-align:right;margin-right:10px;"> Administrator Page</h3>
		<p style="text-align:right;margin-right:10px;">Διαχειριστής, <?= $administration->printusername(); echo " "; ?><a href="logout.php" ><span class="glyphicon glyphicon-log-out"></span> Αποσύνδεση</a></p>
	</div>
			
	
		<div class="row">
			<div class="col-md-3">
			<h4> Menu </h4>
			<hr>
				<ul class="nav nav-pills nav-stacked">
					<li><a href="centralmenu.php">Users</a></li>
					<li><a href="articles.php">Articles</a></li>
					<li class="active"><a href="navbar.php">Edit Navbar</a></li>
				</ul>
			</div>
			
			<div class="col-md-9">
			<h4> Main Page </h4>
			<hr>
			</div>
		</div>
		
		<div class="footer" style="background-color:#1a1a1a;color:#cccccc;border-radius: 5px;">
		<div class="row">
			
			<div class="col-md-12">
			
			 <h1 style="text-align:center;"> Administrator Page</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				
			<p style="text-align:center;">© 2016 Σύλογος Ιεροψαλτών Αθηνών, designed by <a href="https://www.linkedin.com/in/ioannis-kozompolis-373406125">John Kozompolis</a> and George Emmanouil</p>
			
			</div>
		</div>
		</div>
			</div>
		</div>
</div>
</body>
</html>