<?php 
session_start();

require_once "weather.php";

?>
<!doctype html>
<html lang="en">
	<head>
		 
		<meta charset="utf-8" >
		<title>Map -- Art of Brisbane</title>
		<link rel="stylesheet" href="css/index.css?v=<?php echo time();?>">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
		<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
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
				<ul id="project-name">
					<p>ART</p>
					<p>OF</p>
					<p>BRISBANE</p>
				</ul>
				
		</header>
		
		
		


		<div id="page-header">
			<article class="title">
				<h2>Map for all Public Artworks in Brisbane</h2>
				<p>Find the location of artworks in your area.</p>					
				<p>For more information on specific artworks, please click the icons on the map.</p>
				<p>For navigation, please click blue letters in the pop-up window.</p>
			</article>
		</div>


		
		<section>
			<article id="map"></article>
		</section>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- <script src="js/script.js?v=<?php echo time();?>"></script> -->
		<?php require 'map.php'; ?>


		<footer>
		<div class="footer-area">
			<img src="css/images/twitter.png" alt="twitter" >
			<img src="css/images/facebook.png" alt="facebook">
			<img src="css/images/instagram.png" alt="facebook">
			<img src="css/images/youtube.png" alt="facebook">
			
		</div>
	</footer>
		<?php
			// require_once "dataBaseConfig.php";	
			require_once "setDataBase.php";

		?>

	</body>
</html>