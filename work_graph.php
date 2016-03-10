<?php 

session_start();
if(isset($_GET['logout']))
{
	$_SESSION = array();
	if($_COOKIE[session_name()])
	{
		setcookie(session_name(),'',time()-42000,'/');
	}
	session_destroy();
}

if (!isset($_SESSION["username"])) {
    header("location: index.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$usernameID = preg_replace('#[^0-9]#i', '', $_SESSION["usernameID"]); // filter everything but numbers and letters
$username = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["username"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM user WHERE user_name='$username' AND password='$password'"); // query the person
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}

include("phpgraphlib.php");

$graph=new PHPGraphLib(300,250);

$dataArray=array();
  
$sql1 = mysql_query("SELECT timestamp, total_work FROM log WHERE user_name='$username' ORDER BY timestamp ASC LIMIT 5");
$cnt = mysql_num_rows($sql1); // count the output amount
if ($cnt > 0) {
	while($row = mysql_fetch_array($sql1)){ 
             $timestamp = $row["timestamp"];
			 $total_work = $row["total_work"];
             $dataArray[$timestamp]=$total_work;
	}
}
$graph->addData($dataArray);
$graph->setTitle("Recent work activity");
$graph->setGradient("#E82C0C", "#420f00");
$graph->setBarOutlineColor("black");
$graph->createGraph();
?>