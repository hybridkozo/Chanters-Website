<?php
require_once("validation2.php");
$q=$_GET['q'];

$administration->ShowArticlesInTableViaCategory($q);

?>