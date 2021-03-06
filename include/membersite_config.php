<?PHP
require_once("fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('http://localhost/chanters-website/');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('g.kozompolis@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'unipichanters.czbrbzfqqipe.eu-central-1.rds.amazonaws.com',
                      /*username*/'unipiAdmin0',
                      /*password*/'unipialepis8never',
                      /*database name*/'chanters',
                      /*table name*/'users');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>