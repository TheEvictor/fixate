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
require_once('tl.php');

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
			 if($blockRange <= 0){
				     header("location: homepage.php"); 
			 }
	}
}


$sql2 = mysql_query("SELECT * FROM log WHERE user_name='$username' AND timestamp=CURDATE()"); // query the person
  $existCount = mysql_num_rows($sql2); // count the row nums
  if ($existCount == 1) { // evaluate the count
		$sql22 = mysql_query("UPDATE log set total_work = total_work + $workRange WHERE user_name='$username' AND timestamp=CURDATE()");
    } else {
	$sql23 = mysql_query("INSERT INTO log (user_name, timestamp, total_work, total_break) VALUES ('$username', NOW(), '$workRange', '0')") or die (mysql_error());

	}


?>
<html>
  <head>
    <title>Timer</title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"> 

    <link rel="stylesheet" href="assets/css/main.css" />
    <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
<script>
var myVar;

function myFunction() {
    myVar = setTimeout(move, 1000);
}

function move() {
	var workRange = parseInt("<?php echo $workRange;?>");
	var breakRange = parseInt("<?php echo $breakRange;?>");
	var blockRange = parseInt("<?php echo $blockRange;?>");
    var elem = document.getElementById("myBar"); 
    var width = 1;
    var id = setInterval(frame, workRange*10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++; 
            elem.style.width = width + '%'; 
        }
    }
}
</script>
<style type="text/css">
#myProgress {
    position: relative;
    width: 100%;
    height: 30px;
    background-color: grey;
}
#myBar {
    position: absolute;
    width: 1%;
    height: 100%;
    background-color: #E82C0C;
}
</style>
  </head>

<body onLoad="myFunction()">
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
          <h2>TIME REMAINING</h2>
          <p>How much time you have left for this session</p>
        </br>
      </header>

<span id="timer"></span>

</br></br>
<div id="myProgress">
    <div id="myBar"></div>
</div>
	
	 <div id="end">        
        <a href="congratulations.php">
          <p class="submit"><input type="submit" name="commit" value="Finish Session";> </p>
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
  <script>
  var breaktimeB = <?php echo $breakRange ?>;
var worktimeB = <?php echo $workRange ?>;
var sessions = <?php echo $blockRange ?>;

var CountDown = (function ($) {

    // Length ms 
    var TimeOut = 10000;
    // Interval ms
    var TimeGap = 1000;

    var CurrentTime = ( new Date() ).getTime();
    var EndTime = ( new Date() ).getTime() + TimeOut;

    var GuiTimer = $('#countdown');
    var GuiPause = $('#pause').hide();
    var GuiResume = $('#resume').hide();
    var GuiStart = $('#begin');
    var GuiEnd = $('#end').hide();

    var Running = false;

    var UpdateTimer = function() {
        // Run till timeout
        if( CurrentTime + TimeGap < EndTime ) {
            setTimeout( UpdateTimer, TimeGap );
        }
        // Countdown if running
        if( Running ) {
            CurrentTime += TimeGap;
            if( CurrentTime >= EndTime ) {
                GuiTimer.css('color','red');
                GuiEnd.show();
                GuiPause.hide();
            }
        }
        // Update Gui
        var Time = new Date();
        Time.setTime( EndTime - CurrentTime );
        var Minutes = Time.getMinutes();
        var Seconds = Time.getSeconds();

        GuiTimer.php( 
            (Minutes < 10 ? '0' : '') + Minutes 
            + ':' 
            + (Seconds < 10 ? '0' : '') + Seconds );
    };

    var Pause = function() {
        Running = false;
        GuiPause.hide();
        GuiResume.show();
        GuiStart.hide();
        GuiEnd.hide();
    };

    var Resume = function() {
        Running = true;
        GuiPause.show();
        GuiResume.hide();
        GuiStart.hide();
        GuiEnd.hide();
    };

    var Start = function( Timeout ) {
        GuiPause.hide();
        GuiResume.hide();
        GuiStart.show();
        GuiEnd.hide();
        //Running = true;
        TimeOut = Timeout;
        CurrentTime = ( new Date() ).getTime();
        EndTime = ( new Date() ).getTime() + TimeOut;
        UpdateTimer();
    };

    var getTimes = function() {
        $.getJSON("./accounts.php", function(json) {
          //console.log(json[0].accounts);
          sessions = json[0].accounts[0].sessions; 
          var breaktimeA = json[0].accounts[0].breaktime; 
          var worktimeA = json[0].accounts[0].worktime; 

            breaktimeB = <?php echo $breakRange ?>;
			worktimeB = <?php echo $workRange ?>;
			sessions = <?php echo $blockRange ?>;

          Start(worktimeB * 600);
          });
    }

    return {
        Pause: Pause,
        Resume: Resume,
        Start: Start,
        getTimes: getTimes
    };
})(jQuery);

jQuery('#begin').on('click',CountDown.Resume);
jQuery('#pause').on('click',CountDown.Pause);
jQuery('#resume').on('click',CountDown.Resume);

CountDown.getTimes();
CountDown.Start(worktimeB * 600);</script>

</body>
</html>