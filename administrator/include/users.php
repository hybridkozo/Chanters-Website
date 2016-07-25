<?php
				
				$dbhost = 'localhost:3306';
				$dbuser = 'john';
				$dbpass = 'giannis';
				$conn = mysql_connect($dbhost, $dbuser, $dbpass);
				if(!$conn){
					die('could not connect: ' . mysql_error());
				}
				
				$sql='SELECT * FROM users';
				
				mysql_select_db('chanters');
				mysql_query("SET NAMES 'utf8'");
				$retval = mysql_query( $sql, $conn );
				if(! $retval )
				{
					die('Could not get data: ' . mysql_error());
				}
				$i=0;
				echo '<ul class="nav navbar-nav">';
				echo '<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>#ID</th>
        <th>FullName</th>
		<th>Email</th>
        <th>Username</th>
        <th>Admin</th>
      </tr>
    </thead>
    <tbody>';
				while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
						echo '<tr><td>' . $row['id_user'] . '</td><td>' . $row['name'] . '</td><td>' . $row['email'] . '</td><td>' . $row['username'] . '</td><td>' . $row['admin'];
						if ($row['admin']==1){
							echo '</td><td><a data-toggle="tooltip" name="'. $row['id_user'] .'" title="Delete administrator privileges" href="#"><span class="glyphicon glyphicon-minus-sign"></span></a>' . " " . '<a href="#" data-toggle="tooltip" title="Delete this user"><span class="glyphicon glyphicon-remove"></span></a>';
						}else {
							echo '</td><td><a name="'. $row['id_user'] .'" data-toggle="tooltip" title="Give administrator privileges" href="#"><span class="glyphicon glyphicon-ok-circle"></span></a>' . " " . '<a href="#" data-toggle="tooltip" title="Delete this user"><span class="glyphicon glyphicon-remove"></span></a>';
						}
						
						echo '</td></tr>';
						
				}
				
		echo '</tbody></table></div>';
				
				mysql_close($conn);
				
			?>