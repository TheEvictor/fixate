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
    <title>Help</title> 
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
      </section>

    <!-- ACTUAL PAGE STARTS HERE -->
    <section id="sidebar">
      
      <section id="intro">

        <!-- Title -->
        <header>
          <h2>About Fixate</h2>
          <p>Welcome to our glorified timer app.</p>
		

        </header>
        <br>
        
        <h3>Read me first!</h3>
        <p>Fixate is a productivity app inspired by the Pomodoro technique for studying.
         It's basically a fun time management process which teaches you to work with 
         time rather than struggle against it.</p>

        <h3>How do I start?</h3>
        <p>Begin by deciding how long you want to study for.
         Think about a solid period of time you are able to study for uninterrupted.
         Then think about how long you would like your break times to be.
         (For maximum efficiency, we recommend 50/10 study/break sessions)
         Finally, decide how many sets of these you want to do! This can be anything as 
         low as 1 or as high as 10, depending on who much work you have to do.</p>

        <h3>What do I do during break times?</h3>
        <p>This entirely depends on you! You can save your breaks if you're focused and roll them over like cellphone minutes,
        or you can take a break directly after a session of studying. During this time,
        you can generate an activity to give you a cool idea to do something</p>

        <h3>Criticism</h3>
        <p>Your feedback is extremely important as it makes it easier for us to focus 
        on the right stuff. We encourage you to share your ideas and criticism because 
        they play a vital role in the process of building a useful app for you! </p>
      </section>
    </section>
  </div>
 <section id="team">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Team</h2>
        </div>
      </div>
      <div class="team-members">
        <div class="row">
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="member-image">
                <img src="images/team/1.jpg" alt="" class="img-responsive">
              </div>
              <div class="member-info">
                <h3>Diana Ho</h3>
                <h4>Computer Science</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="500ms">
              <div class="member-image">
                <img src="images/team/2.jpg" alt="" class="img-responsive">

              </div>
              <div class="member-info">
                <h3>Alisa Prathnadi</h3>
                <h4>Cognitive Science</h4>
              </div>

            </div>
          </div>
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="800ms">
              <div class="member-image">
                <img src="images/team/3.jpg" alt="" class="img-responsive">

              </div>
              <div class="member-info">
                <h3>Austin Chinn</h3>
                <h4>Computer Science</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="1100ms">
              <div class="member-image">
                <img src="images/team/4.jpg" alt="" class="img-responsive">

              </div>
              <div class="member-info">
                <h3>Rahul Ramath</h3>
                <h4>Computer Science</h4>
              </div>
            </div>
          </div>
        </div>
      </div>            
    </div>
  </section><!--/#team-->
  </br></br></br></br>

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