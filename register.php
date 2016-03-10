<?php 
include "connect_to_mysql.php"; 
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['user_name'])) {
		$pid = mysql_insert_id();//1
    $full_name = mysql_real_escape_string($_POST['full_name']);//2
	$user_name = mysql_real_escape_string($_POST['user_name']);//5
    $password = mysql_real_escape_string($_POST['password']);//6
    $email_id = mysql_real_escape_string($_POST['email_id']);//8
   	$sql = mysql_query("SELECT usernameID FROM user WHERE user_name='$user_name' LIMIT 1");
	$userMatch = mysql_num_rows($sql); // count the output amount
    if ($userMatch > 0) {
		echo "<script>if (window.confirm('Sorry username exists! Do you want to re-register?')){document.location = 'register.php';}else{document.location = 'index.php';}</script>";
		exit();
	}// Add this product into the database now 
	$sql = mysql_query("INSERT INTO user (usernameID, full_name, user_name, password, email_id, workRange, breakRange, blockRange) 
        VALUES('$pid', '$full_name', '$user_name', '$password', '$email_id', 30, 5, 5)") or die (mysql_error());
	header("location: index.php"); 
    exit();
}
?>
<html>
  <head>
    <title>Register an Account</title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
     
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--<link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
<script type="text/javascript" language="javascript"> 
<!--
function validateMyForm ( ) { 
    var isValid = true;
    if ( document.myform.full_name.value == "" ) { 
	    alert ( "Please type your Full Name" ); 
	    isValid = false;
	} else if ( document.myform.user_name.value == "" ) { 
	    alert ( "Please type your User Name" ); 
	    isValid = false;
	
    } else if ( document.myform.user_name.value.length < 5 ) { 
            alert ( "Your name must be at least 5 characters long" ); 
            isValid = false;
			
    } else if ( document.myform.password.value == "" ) { 
            alert ( "Please type your password" ); 
            isValid = false;
    } else if ( document.myform.email_id.value == "" ) { 
            alert ( "Please type your Email ID" ); 
            isValid = false;
    }
    return isValid;
}
function checkEmail() {

    var email = document.getElementById('email_id');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
    email.focus;
    return false;
 }
}
//-->
</script>
  </head>

<body>
  <div id="wrapper">

    <header id="header">
      <nav class="main">
        <ul>

        </ul>
      </nav>
    </header>


    <section id="sidebar">
      
      <section id="intro">

        <!-- Title -->
        <header>
          <h2>Register</h2>
          <p>Create an Account</p>
          <h4><p>All fields are required</p></h4>
        </header>


    <form action="register.php" enctype="multipart/form-data" name="myform" id="myform" method="post">
        <!--<form id='register' method='/get' action='/register'>--> <!-- action='thank-you.php'>-->
        <fieldset >
        <input type='hidden' name='submitted' id='submitted' value='1'/>
        <label for='fullname' >Your Full Name: </label>
        <input name="full_name" type="text" id="full_name" size="64" />
        <label for='email' >Email Address:</label>
        <input name="email_id" type="text" id="email_id" size="12" onchange="checkEmail()" />
         
        <label for='username' >Username:</label>
        <input name="user_name" type="text" id="user_name" size="64" />
         
        <label for='password' >Password:</label>
        <input name="password" type="password" id="password" size="20"/>
        <br>
        <input type="submit" name="button" id="button" value="Register" onclick="javascript:return validateMyForm();"/>
         
        </fieldset>
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
  <script src="assets/rangeslider.min.js"></script>
  <script>
    // Initialize a new plugin instance for all
    // e.g. $('input[type="range"]') elements.
    $('input[type="range"]').rangeslider();

    // Destroy all plugin instances created from the
    // e.g. $('input[type="range"]') elements.
    $('input[type="range"]').rangeslider('destroy');

    // Update all rangeslider instances for all
    // e.g. $('input[type="range"]') elements.
    // Usefull if you changed some attributes e.g. `min` or `max` etc.
    $('input[type="range"]').rangeslider('update', true);
  </script>

</body>
</html>