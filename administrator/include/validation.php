<?php
 require_once("adminfunctions.php");
 $administration=new administration();
 
 $administration->InitDB(/*hostname*/'localhost',
                      /*username*/'john',
                      /*password*/'giannis',
                      /*database name*/'chanters');
?>