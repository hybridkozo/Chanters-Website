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
			$sqlusername=$this->SanitizeForSQL($this->username);
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
		
		
		 function SanitizeForSQL($str){
			 
			if( function_exists( "mysql_real_escape_string" ) ){
				
              $ret_str = mysql_real_escape_string( $str );
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
		
		
	}

?>