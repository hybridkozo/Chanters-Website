<?PHP
require_once("./include/membersite_config.php");

$success = false;
if($fgmembersite->ResetPassword())
{
    $success=true;
}

?>

<div class="col-md-9">
			<?php
			if($success){
			?>
			<h2>Ο κωδικός άλλαξε επιτυχώς!</h2>
			<hr>
			Ο καινούριος κωδικός έχει αποσταλεί στο Email σας
			<?php
			}else{
			?>
			<h2>Σφάλμα!!!</h2>
			<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
			<?php
			}
			?>
			</div>