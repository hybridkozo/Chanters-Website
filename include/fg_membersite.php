<?PHP
/*
 

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class FGMembersite
{
    var $admin_email;
    var $from_address;
    
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $error_message;
	
	var $validationerror;
	
	
    
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'YourWebsiteName.com';
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleError("Παρακαλώ γράψε τον σωστό κωδικό επιβεβαίωσης");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleError("Το όνομα χρήστη είναι κενό!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Παρακαλώ γράψτε τον κωδικό σας!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email κενό!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleError("Old password is empty!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleError("New password is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);
        
        if($user_rec['password'] != md5($pwd))
        {
            $this->HandleError("The old password does not match!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="nobody@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL($username);
        $pwdmd5 = md5($password);
        $qry = "Select name, email from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
        
        
        $_SESSION['name_of_user']  = $row['name'];
        $_SESSION['email_of_user'] = $row['email'];
        
        return true;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysql_query("Select name, email from $this->tablename where confirmcode='$confirmcode'",$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['name'] = $row['name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd = $this->SanitizeForSQL($newpwd);
        
        $qry = "Update $this->tablename Set password='".md5($newpwd)."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Γειά σου ".$user_rec['name']."\r\n\r\n".
        "Καλώς ήρθες στο ".$this->sitename." η εγγραφή σου ολοκληρώθηκε.\r\n".
        "\r\n".
        "Με εκτίμηση,\r\n".
        "Ο Διαχειριστής\r\n".
		"Κοζομπόλης Ιωάννης\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Αποτυχία αποστολής Email");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$user_rec['name']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Ο κωδικός επαναφοράς για το ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpassword.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Γεια σου ".$user_rec['name']."\r\n\r\n".
        "Είχαμε μία αίτηση για επαναφορά κωδικού ".$this->sitename."\r\n".
        "Παρακαλώ πάτα στον σύνδεσμο για την ολοκλήρωση της διαδικασίας: \r\n".$link."\r\n".
        "Με εκτίμηση,\r\n".
        "O Διαχειριστής\r\n".
		"Κοζομπόλης Ιωάννης\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Ο κωδικός σου για το ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Γειά σου ".$user_rec['name']."\r\n\r\n".
        "Ο κωδικός σου άλλαξε. ".
        "Εδώ είναι τα στοιχεία για την είσοδο σου:\r\n".
        "Όνομα χρήστη:".$user_rec['username']."\r\n".
        "Κωδικός:$new_password\r\n".
        "\r\n".
        "Κάντε είσοδο εδώ: ".$this->GetAbsoluteURLFolder()."/loginmine.php\r\n".
        "\r\n".
        "Με εκτίμηση,\r\n".
        "Ο διαχειριστής\r\n".
		"Κοζομπόλης Ιωάννης\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    
    function ValidateRegistrationSubmission()
    {
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) )
        {
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
        $validator = new FormValidator();
        $validator->addValidation("name","req","Please fill in Name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("username","req","Please fill in UserName");
        $validator->addValidation("password","req","Please fill in Password");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['name'] = $this->Sanitize($_POST['name']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['username'] = $this->Sanitize($_POST['username']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['name']);
        
        $mailer->Subject = "Η εγγραφή σας στο ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/index.php?code='.$confirmcode;
        
        $mailer->Body ="Γεια σου ".$formvars['name']."\r\n\r\n".
        "Ευχαριστούμε για την εγγραφή σου στο ".$this->sitename."\r\n".
        "Παρακαλώ πάτα στον σύνδεσμο απο κάτω για να επιβεβαιώσεις την εγγραφή σου.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Με εκτίμηση,\r\n".
        "Ο διαχειριστής\r\n".
		"Κοζομπόλης Ιωάννης\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Αποτυχία αποστολής email επιβεβαίωσης εγγραφής");
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable())
        {
            return false;
        }
        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars,'username'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }        
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select username from $this->tablename where $fieldname='".$field_val."'";
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function DBLogin()
    {

        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable()
    {
        $result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
        $qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
                "password VARCHAR( 32 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    }
    
    function InsertIntoDB(&$formvars)
    {
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        $formvars['confirmcode'] = $confirmcode;
        
        $insert_query = 'insert into '.$this->tablename.'(
                name,
                email,
                username,
                password,
                confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '"
                )';      
        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
        return true;
    }
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }  
	function PresentSingleArticle($id){
			
			
			$conn = mysqli_connect($this->db_host, $this->username, $this->pwd,$this->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			$sql2="SELECT * from comments where id_article='$id'";
			$sql = "SELECT * from articles where id_article='$id'";
			$result = mysqli_query($conn, $sql);
			$result2=mysqli_query($conn, $sql2);
			
			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				
							echo '<hr><h3>' . $row['title'] . '</h3>
							<p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>' . $row['date'] . '</p>
							<p>Γράφτηκε από: <a href="#">' . $row['author'] . '</a></p></br><img src="' . $row['imageurl'] . '" class="img-responsive img-thumbnail" ></a><hr>'. $row['body'] . '<script type="text/javascript" src="http://100widgets.com/js_data.php?id=255"></script><script type="text/javascript" src="http://100widgets.com/js_data.php?id=259"></script><hr>';
							
							if($this->CheckLogin()){
								
								echo '<form role="form" method="GET" action="presentarticle.php">
    <div class="form-group">
		<input type="hidden" id="id" name="id" value="'.$id.'"/>
		<input type="hidden" id="username" name="username" value="'.$this->UserFullName().'"/>
		<input type="hidden" id="articleid" name="articleid" value="'.$id.'"/>
      <label for="comment">Σχόλίασε το άρθρο:</label>
      <textarea class="form-control" rows="3" id="comment" name="comment"></textarea><input type="submit" class="btn btn-default btn-block" value="Υποβολή"/>
    </div>';
							}
							
							echo '<div style="background-color:#d9d9d9;border-radius:10px;"><div style="background-color:#d9d9d9;margin:10px;"><h4></BR><strong>Σχόλια:</strong></h4>';
							if (mysqli_num_rows($result2) > 0) {
			// output data of each row
			while($row2 = mysqli_fetch_assoc($result2)) {
				echo '<p>Ο/Η '. $row2['user'] .' έγραψε:<textarea class="form-control" id="comment">' . $row2['body'] . '</textarea><hr>'  ;
			}
							}else "Κανένα σχόλιο :(";
							echo "</div></div>";
			}}else{
				echo "<hr>Κατι πήγε στραβά το Άρθρο ίσως δεν υπάρχει στην βάση μας<hr>";
				
		
			}
			
			mysqli_close($conn);
			
			
		}
		function InitCarusel(){
			
			echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
 
			<!-- Wrapper for slides -->
			<div class="carousel-inner">';
			
			$conn = mysqli_connect($this->db_host, $this->username, $this->pwd,$this->database);
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			$sql = "SELECT * FROM articles ORDER BY id_article DESC LIMIT 8";
			$result = mysqli_query($conn, $sql);
		
			$active="item active";
			$i=0;
			if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while(($row = mysqli_fetch_assoc($result)) && ($i<3)) {
				if ($i>0){ $active="item";}
				echo '<div class="' .$active .'"><a class="ahref" href="presentarticle.php?id='.$row['id_article'].'">
          <img src="'.$row['imageurl'].'" class="img-thumbnail">
           <div class="carousel-caption">
            <h3>'.$row['title'].'</h3>
            <p>'. substr($row['body'], 0,750) . '....</p>
          </div></a>
        </div>';
				
				
				$i=$i+1;
			}
			
		
        
 
      
      echo '</div><a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
	  </div>
    </div>';
          	while($row = mysqli_fetch_assoc($result)) {
				
				if($i==3){
					echo '<a class="ahref2" href="presentarticle.php?id='.$row['id_article'].'"><div class="col-md-4">
				<img src="'.$row['imageurl'].'" width="260" class="img-thumbnail">
				<h4><strong>' . $row['title'] . '</strong></h4> 
				<p>'. substr($row['body'], 0,750) .'...Περισότερα</p>
			</div></a>
			
			</div>';
				}else if ($i==4){
					echo '<div class="row">
			<a class="ahref2" href="presentarticle.php?id='.$row['id_article'].'"><div class="col-md-4">
				<img src="'.$row['imageurl'].'" width="260" class="img-thumbnail">
				<h4><strong>'.$row['title'].'</strong></h4> 
				<p>'. substr($row['body'], 0,750) .'...Περισότερα</p>
			</div></a>';
				}else if ($i==5){
					echo '<a class="ahref2" href="presentarticle.php?id='.$row['id_article'].'"><div class="col-md-4">
				<img src="'.$row['imageurl'].'" width="260" class="img-thumbnail">
				<h4><strong>'.$row['title'].'</strong></h4> 
				<p>'. substr($row['body'], 0,750) .'...Περισότερα</p>
			</div></a>';
				}else if ($i==6){
					echo '<a class="ahref2" href="presentarticle.php?id='.$row['id_article'].'"><div class="col-md-4">
				<img src="'.$row['imageurl'].'" width="260" class="img-thumbnail">
				<h4><strong>'.$row['title'].'</strong></h4> 
				<p>'. substr($row['body'], 0,750) .'...Περισότερα</p>
			</div></a>
			<div class="row">
			<div class="col-md-12">
			<hr>
			</div>
			</div>
			</div>
			';
				}
			$i=$i+1;
			}
		}
		}
		
		function ValidateCommunitySubmission()
    {
       
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if (empty($_POST["name"])){
					$this->validationerror="Κάτι δεν έχετε συμπληρώσει σωστά";
				 return false;
				}
				if (empty($_POST["email"])){
					$this->validationerror="Κάτι δεν έχετε συμπληρώσει σωστά";
					return false;
				}
				if (empty($_POST["message"])){
					$this->validationerror="Κάτι δεν έχετε συμπληρώσει σωστά";
					return false;
				}
				else{
					
					return true;
				}
		
				
			}
    }
	function SendCommunityEmail($address, $name, $message){
		
	
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->GetFromAddress(),"giannis");
        
        $mailer->Subject = "Μήνυμα από ".$name;

        $mailer->From = $address;        
        
        $mailer->Body = $message;

        if(!$mailer->Send())
        {
            $this->HandleError("Αποτυχία αποστολής email επιβεβαίωσης εγγραφής");
            return false;
        }
        return true;
    
	}
}
?>