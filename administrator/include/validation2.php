<?php
 require_once("adminfunctions.php");
 require_once("../../include/membersite_config.php");
 $administration=new administration();
 
 $administration->InitDB($fgmembersite->db_host,
        $fgmembersite->username,
        $fgmembersite->pwd,
        $fgmembersite->database);
?>