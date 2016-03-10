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
$sql1 = mysql_query("SELECT * FROM user WHERE user_name='$username'");
$cnt = mysql_num_rows($sql1); // count the output amount
if ($cnt > 0) {
	while($row = mysql_fetch_array($sql1)){ 
             $workRange = $row["workRange"];
			 $breakRange = $row["breakRange"];
             $blockRange = $row["blockRange"];

	}
}
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['submit'])) {
    $activity = mysql_real_escape_string($_POST['activity']);//2
	$sql = mysql_query("INSERT INTO activity (activity) VALUES('$activity')") or die (mysql_error());
	echo "<script>if (window.alert('Activity Successfully Added.')){document.location = 'activities.php';}else{document.location = 'activities.php';}</script>";
    exit();
}
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['delete'])) {
    $activity = mysql_real_escape_string($_POST['activity']);//2
	$sql = mysql_query("DELETE FROM `activity` WHERE activity ='$activity'") or die (mysql_error());
	echo "<script>if (window.alert('Activity Successfully Deleted.')){document.location = 'activities.php';}else{document.location = 'activities.php';}</script>";
    exit();
}
?>
<html>
  <head>
    <title>Activities</title> 
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
     
    <link rel="stylesheet" href="assets/css/main.css" />
  	<!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Script to alert user that the activity successfully inputted when they click Submit -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
          $("form").submit(function(e){
              alert("Activity submitted!");
              e.preventDefault();
          });
      });
    </script>-->

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
      </section> -->
    </section>

    <!-- ACTUAL PAGE STARTS HERE -->
    <section id="sidebar">
      
      <section id="intro">

        <!-- Title -->
        <header>
          <h2>ACTIVITIES</h2>
          <p>What would you like to do on your break?</p>
        </header>
        <br>

        <!-- Textbox -->
        <p>Enter new activities here:</p>
    <form action="activities.php" enctype="multipart/form-data" name="myform" id="myform" method="post">
        <input name="activity" type="text" id="activity" size="64" />
</br>
		<input type="submit" name="submit" id="submit" value="insert" /> 
          <p><span id='display'></span></p>
        </form>	
		
		</br>
	<p>Click on the activity below to see complete list.</p>	
    <form action="activities.php" enctype="multipart/form-data" name="myform1" id="myform1" method="post">
        
        <select id="activity" name="activity">
            <?php
            
			$cdquery="SELECT DISTINCT(activity) FROM activity";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
            
            while ($cdrow=mysql_fetch_array($cdresult)) {
            $activity=$cdrow["activity"];
                echo "<option>
                    $activity
                </option>";
            
            }
                
            ?>
    
        </select>
		</br>

        		<input type="submit" name="delete" id="delete" value="delete" /> 
    </form>
		
		
		
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