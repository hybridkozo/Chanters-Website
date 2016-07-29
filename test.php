<?php
$date = new DateTime("now", new DateTimeZone('Europe/Athens') );
echo $date->format('D-M-Y H:i:s');

?>