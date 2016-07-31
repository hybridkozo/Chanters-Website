<?PHP
require_once("adminfunctions.php");
$administration=new administration();

$administration->LogOut();
 $administration->RedirectToURL("../index.php");
	
?>