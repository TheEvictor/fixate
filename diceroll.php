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
?>


<html>
  <head>
    <title>Dice Roll</title> 
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
            <a href="index.php">
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
          <h2>Generate an Activity</h2>
          <p>Need help deciding what to do with your break? Let us give you a hand. </p>
        </br>
      </header>
     
     <div id="activity">
        <h2>
		<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['submit'])) {
	$sql2 = mysql_query("SELECT DISTINCT(activity) FROM activity ORDER BY RAND() LIMIT 1");
$cnt2 = mysql_num_rows($sql2); // count the output amount
if ($cnt2 > 0) {
	while($row2 = mysql_fetch_array($sql2)){ 
             $activity = $row2["activity"];
			 echo $activity;
	}
}
}
?></h2>
     </div>
     </br>
      <div> 
    <form action="diceroll.php" enctype="multipart/form-data" name="myform" id="myform" method="post">
	  		<input type="submit" name="submit" id="submit" value="Roll the Activities Dice"/>
		 </form>
 
      </div>
      <div id="skip">        
        <a href="break.php">
          <p class="submit"><input type="submit" name="commit" value="Continue to Break"> </p>
       </a> 
      </div>

    </div>

  </section>
</section>
</section>
</div>


  <script src="https://code.jquery.com/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/introHCI.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/skel.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>