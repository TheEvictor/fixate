<?php 

session_start();
if (isset($_SESSION["username"])) {
    header("location: homepage.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  
    include "connect_to_mysql.php"; 
    $sql = mysql_query("SELECT usernameID FROM user WHERE user_name='$username' AND password='$password' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $usernameID = $row["usernameID"];
		 }
		 $_SESSION["usernameID"] = $usernameID;
		 $_SESSION["username"] = $username;
		 $_SESSION["password"] = $password;
		 header("location: homepage.php");
         exit();
    } else {
		echo "<script>if (window.confirm('That information is incorrect. Do you want to register?')){document.location = 'register.php';}else{document.location = 'index.php';}</script>";
		exit();
	}
}
?>
<html>
	<head>
		<title>Fixate</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script type="text/javascript" language="javascript"> 
<!--
function abc( ) { 
    var isValid = true;
    if ( document.form1.username.value == "" ) { 
	    alert ( "Please type your Name" ); 
	    isValid = false;
	
    } else if ( document.form1.password.value == "" ) { 
            alert ( "Please type your password" ); 
            isValid = false;
	}
    return isValid;
}
</script>
</head>
	<body>
	<div id="loginDiv">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<nav class="main">
							<ul>
								<!--li class="menu">
									<a class="fa-bars" href="#menu">Menu</a>
								</li>-->
							</ul>
						</nav>

					</header>

					<section id="sidebar">

							<section id="intro">
								<!--<a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>-->
								<header>
									<h2>Fixate</h2>
									<p>The app to get $#!t done</a></p>
									<h4><a href="helpindex.php">Learn more!</a></h4>

								</header>
							
								<br>
						<form id="form1" name="form1" method="post" action="index.php">
								      <p><input name="username" type="text" id="username" placeholder="Username" size="40" /></p>
								      <p><input name="password" type="password" id="password" placeholder="Password" size="40" /></p>

								      <!--<label><a href='reset-pwd-link-sent.php'>Forgot password?</a></label>-->
							<input type="submit" name="button" id="button" value="Log In" onclick="javascript:return abc();" />

								      <section>
           							<ul class="actions vertical">              					

              					<li></br>
              					<a href='register.php' class="button">New User</a>
              					</li>
            						</ul>
        							</section>								      
								    </form>
							</section>
					</section>

			</div>
		</div>
<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>

	</script>
	</body>
</html>