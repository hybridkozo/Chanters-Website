<?php
require_once("validation2.php");
$q=$_GET['q'];
$w=$_GET['w'];

$administration->DeleteArticle($q,$w);

?>