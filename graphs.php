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
$sql = mysql_query("SELECT * FROM user WHERE user_name='$username' AND password='$password' "); // query the person
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}

$sql1 = mysql_query("SELECT timestamp, total_work, total_break FROM log WHERE user_name='$username'");
$cnt = mysql_num_rows($sql1); // count the output amount
$absolutework = 0;
$absolutebreak = 0;
if ($cnt > 0) {
	while($row = mysql_fetch_array($sql1)){ 
	     $absolutework += $row["total_work"];
	     $absolutebreak += $row["total_break"];
	}
}
?>
<html>
  <head>
    <title>Graphs</title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
     
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
  </head>

<body>
  <div id="wrapper">

    <header id="header">
      <nav class="main">
        <ul>
          <li class="menu">
          <a class="fa-bars" href="#menu">Menu</a>
          </li>
        </ul>
      </nav>

      <h1><a href="timer.php">Fixate</a></h1>
    </header>

    <!-- Menu -->
<section id="menu">

      <!-- Links -->
       <section>
        <ul class="links">
          <li>
            <a href="homepage.php">
              <h3>Timing</h3>
              <p>Reset your sessions/breaks</p>
            </a>
          </li>
          <li>
            <a href="activities.php">
              <h3>Activities</h3>
              <p>Add/View your activities</p>
            </a>
          </li>

          <li>
            <a href="graphs.php">
              <h3>Graphs</h3>
              <p>Check your progress</p>
            </a>
          </li>

          <li>
            <a href="settings.php">
              <h3>Settings</h3>
              <p>Change your preferences</p>
            </a>
          </li>
          
		  <li>
            <a href="help.php">
              <h3>Help</h3>
              <p>Learn how to use this app</p>
            </a>
          </li>
          <li>
		    <a href="homepage.php?logout=1">
              <h3>Logout</h3>
              <p>Goodbye</p>
            </a>
          </li>
        </ul>
      </section>

      <!-- Actions 
      <section>
        <ul class="actions vertical">
          <li>
          <a href="#" class="button big fit">Log In</a>
          </li>
        </ul>
      </section>-->
    </section>


    <!-- ACTUAL PAGE STARTS HERE -->
    <section id="sidebar">
      
      <section id="intro">

        <!-- Title -->
        <header>
          <h2>GRAPHS</h2>
          <p>Visualize your journey</p>
        </header>
        <br>

		<div>
		<h3>Work Analytics</h3>
		<p> Lifetime work minutes accumulated: <?php echo $absolutework ?></p>
<img src="work_graph.php" />
		</div>
		</br></br>		</br></br>
		<div>
		<h3>Break Analytics</h3>
		<p> Lifetime break minutes accumulated: <?php echo $absolutebreak ?></p>
<img src="break_graph.php" />
		</div>
		</br>
		<p>Graphs display activity from the past 5 most recent days you have used Fixate.</p>
		
		
      </section>
    </section>
  </div>

  <!-- All javascript files go here -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/introHCI.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/skel.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>