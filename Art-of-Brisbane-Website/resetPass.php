<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 
require_once "dataBaseConfig.php";
 
// Define variables and initialize with empty values=
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
$username = $_SESSION["username"];
 

// Check if the form is empty
if (empty($_POST["new_password"]) && empty($_POST["confirm_password"])) {
    $emptyForm = true;
}
 
// Validate new password
if(empty($_POST["new_password"])){
    $new_password_err = "Please enter the new password";     
} elseif(strlen($_POST["new_password"]) < 6){
    $new_password_err = "Password must have atleast 6 characters";
} else{
    $new_password = $_POST["new_password"];
}

// Validate confirm password
if(empty($_POST["confirm_password"])){
    $confirm_password_err = "Please confirm the password";
} else{
    $confirm_password = $_POST["confirm_password"];
    if(empty($new_password_err) && ($new_password != $confirm_password)){
        $confirm_password_err = "Password did not match";
    }
}
    
// Check input errors before updating the database
if(empty($new_password_err) && empty($confirm_password_err)){
    // Prepare an update statement
    $stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE username = ?");
    
    if(!$stmt){
        echo "<script>alert('mysqli error');</script>";
    }else{
        mysqli_stmt_bind_param($stmt, 'ss', $password, $username);
        mysqli_stmt_execute($stmt);
        header("location: login.php");
    }

        // Close statement
        mysqli_stmt_close($stmt);
}
    
    // Close connection
    mysqli_close($link);

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
					<h4>RESET PASSWORD</h4>
					<form action="login.php" method="post">
						
						<input type="password" name="password" placeholder="Password" class="input">
						<span class="account-alert"><?php if (!$emptyForm) {echo $new_password_err; }?></span>

						<input type="password" name="confirm_password" placeholder="Confirm Password" class="input">
						<span class="account-alert"><?php if (!$emptyForm) {echo $confirm_password_err; }?></span>

						<input type="submit" value="Submit" class="button">
						<br>
						<a href="index.php" style="font-size: 2em">
							 Guest mode 
						</a>
					</form>
					<div class="more">
						<a href="register.php" style="font-size: 2em">Register</a>
						<a href="login.php" style="font-size: 2em">Login</a>
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