<?php

	

	class administration {
		var $username,$password;
		var $errorUsername,$errorPassword;
		var $noUserError;
		var $sqlusername;
		var $sqlpassword;
		
	
		
		//database configuration
		
		var $server,$user,$pass,$database;
		
		function InitDB($server,$user,$pass,$database){
			
			$this->server=$server;
			$this->user=$user;
			$this->pass=$pass;
			$this->database=$database;
			
		}
		
		function validateForm(){
			
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if (empty($_POST["username"])){
					$this->errorUsername="Παρακαλώ δώστε όνομα χρήστη!";
				
				} else {
					$this->username=$this->test_input($_POST["username"]);
				}
				if (empty($_POST["password"])){
					$this->errorPassword="Παρακαλώ δώστε ένα κωδικό";
					
				}else{
					$this->password=$this->test_input($_POST["password"]);
					
				}
				if ((!empty($_POST["username"]))&&(!empty($_POST["password"]))){
					return true;
				}
				
			}
		}
		
		function test_input($data){
			$data=trim($data);
			$data= stripslashes($data);
			$data= htmlspecialchars($data);
			return $data;
		}
		
		
		function RedirectToURL($url){
			
        header("Location: $url");
        exit;
		}
		
		function CheckUser(){
			
			// Create connection
			
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			// Check connection
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			$sqlusername=$this->SanitizeForSQL($conn,$this->username);
			$sqlpassword=md5($this->password);
			
			$sql = "select name, email from users where username='$sqlusername' and password='$sqlpassword' and admin='1'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if(!isset($_SESSION)){ session_start(); }
				$_SESSION[$this->GetLoginSessionVar()] = $sqlusername;
				$_SESSION['user'] = $row['name'];
				return true;
			}
			} else {
			$this->noUserError="Λάθος στοιχεία!!! Δεν υπάρχει τέτοιος Administrator!!";
				return false;
			}

			mysqli_close($conn);
			
		
		}
		
		
		 function SanitizeForSQL($conn,$str){
			 
			if( function_exists( "mysql_real_escape_string" ) ){
				
              $ret_str = mysqli_real_escape_string($conn, $str );
			}else{
              $ret_str = addslashes( $str );
			}
			return $ret_str;
		}
		
		function GetLoginSessionVar(){
			
			$retvar = md5('qSRcVS6DrTzrPvr');
			$retvar = 'usr_'.substr($retvar,0,10);
			return $retvar;
		}
		
		function CheckLogin(){
         
			if(!isset($_SESSION)){ 
				session_start(); 
			}

			$sessionvar = $this->GetLoginSessionVar();
         
				if(empty($_SESSION[$sessionvar])){
				return false;
				}
			return true;
		}
		
		function printusername(){
			return isset($_SESSION['user'])?$_SESSION['user']:'';
		}
		
		 function LogOut(){
			session_start();
        
			$sessionvar = $this->GetLoginSessionVar();
        
			$_SESSION[$sessionvar]=NULL;
        
			unset($_SESSION[$sessionvar]);
		}
		
		function ChangePrivileges($id){
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			// Check connection
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			
			$sql = "select admin from users where id_user=$id";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				if ($row['admin']==0){
					$sql2="UPDATE users SET admin=1 WHERE id_user=$id";
					$result2 = mysqli_query($conn, $sql2);
				}else{
					$sql2="UPDATE users SET admin=0 WHERE id_user=$id"; 
					$result2 = mysqli_query($conn, $sql2);
				}
			}
			
			}
			mysqli_close($conn);
			
			
		}
		function SaveArticle($title,$datetime,$author,$category,$imageurl,$body){
			$temp;
			
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			
			// Check connection
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			$sql2="select * from category where name='$category'";
			$result = mysqli_query($conn, $sql2);
			$row = mysqli_fetch_assoc($result);
				$temp=$row['id_category'];
			
			
			$sql="INSERT INTO articles (title, date, author, id_category, imageurl, body) VALUES ('$title', '$datetime', '$author', '$temp', '$imageurl', '$body')";
			
			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			mysqli_close($conn);
			
			
		}
		function DeleteUser($id){
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			// Check connection
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			
			$sql = "DELETE FROM users WHERE id_user=$id";
			$result = mysqli_query($conn, $sql);
			
			mysqli_close($conn);
			
			
		}
		
		
		
		function EditMenu(){
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * from menu";
			$result = mysqli_query($conn, $sql);
			echo '<h2>Edit Menu</h2>
			<form role="form">
    <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>#id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Link</th>
        <th>Sequence</th>
        <th>Submenu</th>
      </tr>
    </thead>
    <tbody>';
     
			
			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			echo '
			 <tr>
        <td>'.$row['idmenu'].'</td>
        <td>'.$row['name'].'</td>
			<td>'.$row['description'].'</td>
        <td>'.$row['link'].'</td>
        <td>'.$row['sequence'].'</td>
        <td>'.$row['submenu'].'</td>
      </tr>';
			
			
			}
			
		}
		
		echo '  </tbody>
  </table>
  </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>';
		
		}
		
		function PrintArticleCategoriesInSelectList(){
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * from category";
			$result = mysqli_query($conn, $sql);
			echo	' <label for="sel1">Κατηγορία (προεπιλογή όλες):</label>
			<select name="users" class="form-control" id="sel1" onchange="showArticles(this.value)">
								<option value="null">Επιλέξε κατηγορία...</option>';
			while($row = mysqli_fetch_assoc($result)) {
				
			echo	'<option value="'.$row['id_category'].'">'.$row['name'].'</option>';
				
			}
			
			echo '</select>';
			
			mysqli_close($conn);
		}
		
		function ShowArticlesInTableViaCategory($category){
			
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			if ($category=="null"){
				$sql = "SELECT * from articles ORDER BY id_article DESC";
			}else{
			$sql = "SELECT * from articles where id_category='$category' ORDER BY id_article DESC";
			}
			$result = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_assoc($result)) {
				
			echo	'<tr><td>'.$row['id_article'].'</td><td>'.$row['title'].'</td><td>'.$row['author'].'</td><td>'.$row['id_category'].'</td><td><button onclick="deleteArticle('.$row['id_article'].','.$category.')" class="btn btn-success">Διαγραφή</button></td></tr>';
				
			}
			
			
			
			mysqli_close($conn);
			
			
		}
		
		function DeleteArticle($id,$category){
			
			$conn = mysqli_connect($this->server, $this->user, $this->pass,$this->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			
			$delsql="DELETE FROM articles WHERE id_article=$id";
			mysqli_query($conn, $delsql);
			if ($category=="null"){
				$sql = "SELECT * from articles ORDER BY id_article DESC";
			}else{
			$sql = "SELECT * from articles where id_category='$category' ORDER BY id_article DESC";
			}
			$result = mysqli_query($conn, $sql);
			
			while($row = mysqli_fetch_assoc($result)) {
				
			echo	'<tr><td>'.$row['id_article'].'</td><td>'.$row['title'].'</td><td>'.$row['author'].'</td><td>'.$row['id_category'].'</td><td><button onclick="deleteArticle('.$row['id_article'].')" class="btn btn-success">Διαγραφή</button></td></tr>';
				
			}
			
			
			
			mysqli_close($conn);
			
			
		}
		
		
	}

?>