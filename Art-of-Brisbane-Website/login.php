<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
require_once "dataBaseConfig.php";
 
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Check if the form is empty
if (empty($_POST["username"]) && empty($_POST["password"])) {
    $emptyForm = true;
}


 
// Check if username is empty
if(empty($_POST["username"])){
	$username_err = "Please enter username";
} else{
	$username = $_POST["username"];
}

// Check if password is empty
if(empty($_POST["password"])){
	$password_err = "Please enter your password";
} else{
	$password = $_POST["password"];
}

// Validate credentials
if(empty($username_err) && empty($password_err)){
	$sql = "SELECT * FROM users WHERE username = '$username' and password='$password'";
	$result = mysqli_query($conn, $sql);

	if($row=mysqli_fetch_assoc($result)){

		session_start();	
		// Store data in session variables
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $row['username'];                            
						
		// Redirect user to home page
		header("location: index.php");
		} else{
			// Password is not valid, display a generic error message
			$login_err = "Invalid username or password";
	}
}

// Close connection
mysqli_close($conn);

?>



<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Account -- Art of Brisbane</title>
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/account.css">
    </head>
    <body>
 
        <header>
	

			<div class="box">
				<div class="left">
				</div>
				<div class="right">
					<h4>SIGN IN</h4>
					<?php 
					if(!empty($login_err)){
            			echo '<div class="account-alert">' . $login_err . '</div>';
        			}        
        			?>
					<form action="login.php" method="post">
						
						<input type="text" name="username" placeholder="Username" class="input">
						<span class="account-alert"><?php if (!$emptyForm) {echo $username_err;}?></span>
						
						<input type="password" name="password" placeholder="Password" class="input">
						<span class="account-alert"><?php if (!$emptyForm) {echo $password_err; }?></span>
						
						<input type="submit" value="Login" class="button">
						
						<br>
						<!-- <a href="index.php" style="font-size: 2em">
							 Guest mode 
						</a> -->
					</form>
					<div class="more">
						<a href="register.php" style="font-size: 2em">Register</a>
						<a href="index.php" style="font-size: 2em">Guest mode </a>
					</div>
				</div>
		
			</div>





            <!-- <footer>
                <div class="footer-area">
                    <article class="footer-article">
 
                    </article>
                </div>
            </footer> -->

	</body>
</html>