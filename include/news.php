<div class="col-md-9">
			<?php
require_once("administrator/include/validation.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php?action=login.php");
    exit;
}

$administration->PresentArticles('news');
?>
</div>