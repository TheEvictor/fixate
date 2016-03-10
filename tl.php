<?php 
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
	while($row = mysql_fetch_array($sql)){ 
             $workRange = $row["workRange"];
			 $breakRange = $row["breakRange"];
             $blockRange = $row["blockRange"];

	}
}
?>

<script type="text/javascript">
			// parse the PHP variables to javascript (because I don't know how to do equivalent in js yet)
			var workRange = parseInt("<?php echo $workRange;?>");
			var breakRange = parseInt("<?php echo $breakRange;?>");
			var blockRange = parseInt("<?php echo $blockRange;?>");

				
				// get the difference between the next time and the time now to work out how long there is to go in seconds
				var dif = workRange;
			// run the timer
			var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
			
			function timer()
			{
				
				// if we reach the target time then restart the timer for the next time we want to count down to
				if(dif == 0){
					clearInterval(counter);
					var announce = setInterval(announcement, 1000);
					
				}else{
					
					// work out how many hours, minutes and seconds there are
					var dh1 = Math.floor(dif/3600) % 24;
					var	dm1 = Math.floor(dif/60) % 60;
					var ds1 = dif % 60; 
					
					// countdown one second
					dif=dif-1;
					// show current time left on the countdown timer
					document.getElementById("timer").innerHTML="<span id=\"countdown\">"+dh1+"h "+dm1+"m "+ds1+"s</span>";
				}
			}
	
			// How long the announcement will last when time is reached in seconds
			var announceTime = 5;
			
			function announcement()
			{
				if(announceTime == 0){
					
					clearInterval(announce);
				}else{
					announceTime = announceTime - 1;
					//document.getElementById("timer").innerHTML="<span id=\"countdown\"><a href=\"congratulations.php\"><p class=\"submit\"><input type=\"submit\" name=\"commit\" value=\"Finish Session\";></p></a></span>";
					document.getElementById("timer").innerHTML="<span id=\"countdown\"><?php if(($blockRange-1) == 0): ?> <a href=\"congratulationsfinal.php\"><p class=\"submit\"><input type=\"submit\" name=\"commit\" value=\"Finish Session\";></p></a><?php else: ?><a href=\"congratulations.php\"><p class=\"submit\"><input type=\"submit\" name=\"commit\" value=\"Finish Session\";></p></a>	<?php endif; ?></span>";
					/*document.getElementById("timer").innerHTML="
	<span id=\"countdown\">
	<?php echo ($blockRange-1)?>
	<?php if(($blockRange-1) == 0): ?> 
		<a href=\"congratulationsfinal.php\">
        	<p class=\"submit\"><input type=\"submit\" name=\"commit\" value=\"Finish Session\";></p>
        	</a>
	<?php else: ?>
		<a href=\"congratulations.php\">
        	<p class=\"submit\"><input type=\"submit\" name=\"commit\" value=\"Finish Session\";></p>
        	</a>	
	<?php endif; ?>
	</span>";*/
				}	
			}
			
</script>