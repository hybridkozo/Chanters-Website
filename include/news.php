<div class="col-md-9">
			<?php

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php?action=login.php");
    exit;
}

$fgmembersite->PresentArticles('news');
?>
</div>