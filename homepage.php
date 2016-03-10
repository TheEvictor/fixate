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
else {
$row = mysql_fetch_array($sql);
$fullname = $row["full_name"];
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
    $workRange = mysql_real_escape_string($_POST['workRange']);//2
	$breakRange = mysql_real_escape_string($_POST['breakRange']);//3
	$blockRange = mysql_real_escape_string($_POST['blockRange']);//4
	$sql = mysql_query("UPDATE user set workRange='$workRange',breakRange='$breakRange',blockRange='$blockRange',breakRangeRoll='$breakRange' where user_name='$username'") or die (mysql_error());
	header("location: timer.php"); 
    exit();
}
?>
<html>
  <head>
    <title>Home Page</title> 
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"> 

    <link rel="stylesheet" href="assets/css/main.css" />
  	<!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
  	<style type="text/css">
  	.details {
    		display: none;
    		font-family: Century Gothic; 
	  }
	</style>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
	    $(function() {
        	$(".project").on('click', function() { 
            	$(this).parent().find('.details').slideDown();
        	});
    	});
	</script>
  </head>

<body>
<?php include_once("analyticstracking.php") ?>
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
        <h3> Welcome, <?php echo $fullname; ?>
		        <h2>STUDY PERIODS</h2>
				<p>Based on studies on the Pomodoro technique,</p>
				<h3>we recommend 50/10 study/break sessions for maximum efficiency.</h3>
         
		  
		   <!-- <h4><a href="help.php">Click here if you need help!</a></h4> -->
			</header>
         <!--  <h2>SET STUDY SESSION TIMES</h2>
          <div>
          <p class="project">Our app is inspired by the Pomodoro Technique for studying. Click here!</p>
  		<div class="details">The Pomodoro Technique blehlebelehehebhe</div> 
	</div> -->
        
      </section>

    <!-- Study options -->
    <section class="container">

      <div align="center">
<p style="font-size:90%;"> How many minutes do you want to study for per session? </p>	  
    <form action="homepage.php" enctype="multipart/form-data" name="myform" id="myform" method="post">
	     <input type="range" id="workRange" name="workRange" min="10" max="50" value="<?php echo intval($workRange); ?>" step="5" oninput="this.form.workInput.value=this.value" />
		 Work Time:  <input type="number" id="workInput" name="workInput" min="10" max="50" value="<?php echo intval($workRange); ?>" step="5" oninput="this.form.workRange.value=this.value" />
		 </br></br></br>
		 <p style="font-size:90%;"> How many minutes do you want each break session to last between study sessions? </p>
		<input type="range"  id="breakRange" name="breakRange" min="0" max="10" step="1" value="<?php echo intval($breakRange); ?>" oninput="this.form.breakInput.value=this.value" />
		 Break Time:  <input type="number" id="breakInput"  name="breakInput" min="0" max="10" step="1" value="<?php echo intval($breakRange); ?>" oninput="this.form.breakRange.value=this.value" />
				 </br></br></br>
				  <p style="font-size:90%;"> How many sets of study and break sessions do you want? </p>
		<input type="range"  id="blockRange" name="blockRange" min="1" max="10" value="5" step="1" oninput="this.form.blockInput.value=this.value" />
		 Number of Blocks:  <input type="number"  id="blockInput" name="blockInput" min="1" max="10" value="5" step="1" oninput="this.form.blockRange.value=this.value" />
		 		 </br></br></br>
		<input type="submit" name="submit" id="submit" value="Submit"/>
		 </form>

      <br>
      <br>
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