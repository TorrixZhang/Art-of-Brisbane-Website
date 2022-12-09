<?php
require_once "dataBaseConfig.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted

// Check if the form is empty
if (empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["confirm_password"])) {
    $emptyForm = true;
}
 
// Validate username
if(empty($_POST["username"])){
    $username_err = "Please enter a username";
} elseif(!preg_match('/^[a-zA-Z_]+$/', $_POST["username"])){
    $username_err = "Username can only contain letters and underscores";
} else{

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if($row=mysqli_fetch_assoc($result)){
        $username_err = "This username is already taken";
    } else{
            $username = $_POST["username"];
        }
    }


// Validate password
if(empty($_POST["password"])){
    $password_err = "Please enter a password.";     
} elseif(strlen($_POST["password"]) < 6){
    $password_err = "Password must have atleast 6 characters.";
} else{
    $password = $_POST["password"];
}

// Validate confirm password
if(empty($_POST["confirm_password"])){
    $confirm_password_err = "Please confirm password.";     
} else{
    $confirm_password = $_POST["confirm_password"];
    if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match";
    }
}

// Check input errors before inserting in database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    
    // Prepare an insert statement
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
        
    if(!$stmt){
        echo "<script>alert('mysqli error');</script>";
    }else{
        mysqli_stmt_bind_param($stmt, 'ss', $username,$password);
        mysqli_stmt_execute($stmt);
        header("location: login.php");
    }

    // Close statement
    mysqli_stmt_close($stmt);
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
					<h4>REGISTER</h4>

					<form action="register.php" method="post">
						
						<input type="text" name="username" placeholder="Username" class="input">
						<span class="account-alert"><?php if (!$emptyForm) {echo $username_err;}?></span>
						
						<input type="password" name="password" placeholder="Password" class="input">
						<span class="account-alert"><?php if (!$emptyForm) {echo $password_err;} ?></span>
						
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="input">
						<span class="account-alert"><?php if (!$emptyForm) { echo $confirm_password_err;} ?></span>
						<input type="submit" value="Confirm" class="button">
						
						<!-- <br>
						<a href="index.php" style="font-size: 2em">
							 Guest mode 
						</a> -->
					</form>
					<div class="more">
						<a href="login.php" style="font-size: 2em">Login</a>
						<a href="index.php" style="font-size: 2em">Guest mode</a>
					</div>
				</div>
		
			</div>