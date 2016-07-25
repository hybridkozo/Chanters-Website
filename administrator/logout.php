<?PHP
require_once("./include/adminfunctions.php");
$administration=new administration();

$administration->LogOut();
 $administration->RedirectToURL("index.php");
	
?>