<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('fixateucsd.herokuapp.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('fixateucsd@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'fixateucsd',
                      /*password*/'fixateucsd',
                      /*database name*/'testdb',
                      /*table name*/'fixateusers');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('kf1mIibCTObmxZj');

?>