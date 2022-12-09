<?php 
session_start();

require_once "weather.php";

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>About_us -- Art of Brisbane</title>
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
		<header class="page-home">
			<nav id="main-menu">
                <div1 class="topleft" >
					<img src="css/images/topleft1.png" alt="projectLogo" >
					<img src="css/images/topleft2.png" alt="projectLogo" >
				</div1>
				
				<ul id="navigation">
					<li>
						<a>Today: <?php echo $tempNow['temp'] ?>°C <?php echo $description['main'] ?></a>
					</li>
					<li>
						<a href="index.php">HOME</a>
					</li>
					<li>
						<a href="scanning.php">SCANNING</a>
					</li>
					<li>
						<a href="information.php">INFORMATION</a>
					</li>
					<li>
						<a href="about_us.php">ABOUT US</a>
					</li>
					<li>
						<a href="references.php">REFERENCES</a>
					</li>

					<li>
						<?php 
						if($_SESSION["loggedin"] === true){
							$link="logout.php";
							$dropDown= true;
							$displayName=strtoupper($_SESSION["username"]);
						}else{
							$link="login.php";
							$displayName="LOGIN";
						}
						?>
						<a href="<?php echo $link ?>" id="dropdown" style="color: rgb(18, 123, 188); text-decoration: underline">
						<?php echo $displayName ?></a>
						<div id="dropdown-content">
							<?php 
							if ($dropDown){
								echo'<a id="dropdown-list1" href="logout.php">LOGOUT</a><hr>';
                    			echo'<a id="dropdown-list2" href="resetPass.php">RESET PASSWORD</a><hr>';
							}
							?>
						</div>
					</li>
				</ul>
				
 
			</nav>
        <header>



		<div id="page-header">
			<article class="title">
				<h2>Team members</h2>
				<p>Xiangjing Mao, YuLiang, </p>					
				<p></p>
			</article>
		</div>



			

		<footer>
		<div class="footer-area">
			<img src="css/images/twitter.png" alt="twitter" >
			<img src="css/images/facebook.png" alt="facebook">
			<img src="css/images/instagram.png" alt="facebook">
			<img src="css/images/youtube.png" alt="facebook">
			
		</div>
	</footer>
    
    </body>
</html>