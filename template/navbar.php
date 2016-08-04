<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>	
							<a class="navbar-brand" href="#"><strong></strong></a>
					</div>
					<div class="collapse navbar-collapse"  id="myNavbar">				
				<?php
				require_once("include/dynamicmenu.php");
				?>
				
				
				<?PHP
					require_once("./include/membersite_config.php");

					if(!$fgmembersite->CheckLogin()){
						echo '<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php?action=register.php" ><span class="glyphicon glyphicon-user"></span> Εγγραφή</a>
							</li>
							
							<li><a href="index.php?action=login.php" ><span class="glyphicon glyphicon-log-in"></span> Είσοδος</a>
							</li>
						</ul>
									</div>
							</div>';
					}else {
						echo '<ul class="nav navbar-nav navbar-right">
							
							<li><a href="logout.php" >Γεια σου,' . $fgmembersite->UserFullName() .' ' . '<span class="glyphicon glyphicon-log-out"></span> Αποσύνδεση</a>
							</li>
						</ul>
									</div>
							</div>';
					}

				?>
						
</nav>