<?php
				require_once("membersite_config.php");
				$dbhost = $fgmembersite->db_host;
				$dbuser = $fgmembersite->username;
				$dbpass = $fgmembersite->pwd;
				$conn = mysql_connect($dbhost, $dbuser, $dbpass);
				if(!$conn){
					die('could not connect: ' . mysql_error());
				}
				
				$sql='SELECT * FROM menu ORDER by sequence;';
				
				mysql_select_db('chanters');
				mysql_query("SET NAMES 'utf8'");
				$retval = mysql_query( $sql, $conn );
				if(! $retval )
				{
					die('Could not get data: ' . mysql_error());
				}
				$i=0;
				echo '<ul class="nav navbar-nav">';
				while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
					if ($i==0 and $row['submenu']==NULL){
						echo '<li><a href="' . $row['link'] . '">' . $row['name'] . '</a></li>';
						
					}
					else if ($i>0 and $row['submenu']==NULL){
					echo '<li><a href="' . $row['link'] . '">' . $row['name'] . '</a></li>';
					}
					else
					{
						$id=$row['idmenu'];
						$sql2="SELECT * FROM submenu WHERE idmenu='$id' ORDER BY sequence;" ;
						$retval2 = mysql_query( $sql2, $conn );
						if(! $retval2 )
						{
							die('Could not get data: ' . mysql_error());
						}
						if ($i==0){
						echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href=" ' . $row['link'] . '">' . $row['name'] . '<span class="caret"></span></a>';
						}
						else{
							echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="' . $row['link'] . '">' . $row['name'] . '<span class="caret"></span></a>';
						}
						echo '<ul class="dropdown-menu">';
						while($row2 = mysql_fetch_array($retval2, MYSQL_ASSOC)){
							echo '<li><a href="' . $row2['link'] . '">' . $row2['name'] . '</a></li>';
						}
						echo "</ul>";
						echo "</li>";
						
					}
					
					$i++;
				}
				echo "</ul>";
				
				mysql_close($conn);
				
			?>