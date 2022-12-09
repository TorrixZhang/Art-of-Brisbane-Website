<?php 
session_start();

require_once "weather.php";

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Scanning -- Art of Brisbane</title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		
        <link rel="stylesheet" href="css/index.css">		
		<script src="js/camera.js"></script>
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
						<a href="team.php">TEAM</a>
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
						<a href="<?php echo $link ?>" id="dropdown" >
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

            <div id="page-header-scan">
				<article class="title">
					<h2>Scanning Feature</h2>
					<p>Enabling you to scan artwork to get related information.</p>					
				</article>
			</div>



		<div class="cameraButton">
		<button onclick="showCamera()" id="disappear">
			Scan Artwork
		</button>
		</div>
		<div class="bg-content" style="display: none;">
			<div class="show-photo">
				<video id="video" width="600px" height="600px" autoplay="autoplay"></video>
				<canvas id="canvas" width="600px" height="600px" style="display: none;"></canvas>
				<a id="downloadA"></a>
			</div>

			<div class="Identify art collection">
				<button type="button" onclick="jumpToInfo()">
					Identify art collection
				</button>
			</div>	
			<!--<div class="close-photo">
				<button type="button" onclick="closePhoto()">
					Turn off the camera
				</button>
			</div>
			-->
			
		</div>



        <header>

			


<div class="otherimages">		
<img src="css/images/scanBgd.jpg" alt="thismustbetheplace." >
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