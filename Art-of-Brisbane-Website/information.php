<?php
session_start();

require_once "weather.php";

require_once "dataBaseConfig.php";

if ($_POST['category'] == 'name') {
	$category = "Item_title";
} elseif ($_POST['category'] == 'year') {
	$category = "Installed";
} elseif ($_POST['category'] == 'location') {
	$category = "The_Location";
}

$content = $_POST['content'];


$sql = "SELECT * FROM `arts` WHERE `$category` LIKE '%$content%' ";
$result = mysqli_query($conn, $sql);

?>




<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Information -- Art of Brisbane</title>
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
</head>

<body>
	<header class="page-home">
		<nav id="main-menu">
			<div1 class="topleft">
				<img src="css/images/topleft1.png" alt="projectLogo">
				<img src="css/images/topleft2.png" alt="projectLogo">
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
					if ($_SESSION["loggedin"] === true) {
						$link = "logout.php";
						$dropDown = true;
						$displayName = strtoupper($_SESSION["username"]);
					} else {
						$link = "login.php";
						$displayName = "LOGIN";
					}
					?>
					<a href="<?php echo $link ?>" id="dropdown" >
						<?php echo $displayName ?></a>
					<div id="dropdown-content">
						<?php
						if ($dropDown) {
							echo '<a id="dropdown-list1" href="logout.php">LOGOUT</a><hr>';
							echo '<a id="dropdown-list2" href="resetPass.php">RESET PASSWORD</a><hr>';
						}
						?>
					</div>
				</li>
			</ul>



		</nav>
		<div id="page-header3">
			<article class="title">
 
				<h2>The Art Collection of Brisbane</h2>
				<p>Scroll down to see the list of Art Collection.</p>
			</article>

		</div>

		<header>
			<div>
				<br>
				<form action="information.php" method="POST" class="searchByNYL">
					<div class="category">
						<select name="category">
						<option value="name">Name</option>
						<option value="year">Year</option>
						<option value="location">Location</option>
					</select>
					</div>
					<input type="text" name="content" placeholder="Search content" class="input">
					<input type="submit" value="Confirm" class="search">
					<!-- <span class="search-alert"><?php echo $search_err; ?></span> -->
				</form>
			</div>
			<section id="list">

				<?php
				if ($content && $category){
					while ($row = mysqli_fetch_assoc($result)) {
				?>
					<section class="lists" style="background-color: grey;">
						<h2><?php echo $row['Item_title'] ?></h2>
						<h3>Installed in: <?php echo $row['Installed'] ?></h3>
						<h3>Artist:<?php echo $row['Artist'] ?></h3>
						<h3>Material: <?php echo $row['Material'] ?></h3>
						<h3>Location: <?php echo $row['The_Location'] ?></h3>
						<p><?php echo $row['Description'] ?></p>
					</section>
				<?php }} ?>
			</section>
			<br><hr><br><br>

			<section id="lists">
				<?php
				header('content-type:text/html;charset=utf-8');

				// connect the database
				$conn = mysqli_connect('localhost', 'test1', 'test1', 'publicArts') or die('Database access error!');
				mysqli_query($conn, 'set names utf8');

				// get the page number
				if (empty($_GET['p'])) {
					$p = 1;
				} else {
					$p = $_GET['p'];
				}

				$sql = "select * from arts";
				// excute the sql
				$artsData = mysqli_query($conn, $sql);
				$rowsNum = mysqli_num_rows($artsData);
				$elementsNum = 15;
				$totalPage = ceil($rowsNum / $elementsNum);
				$nowElements = ($p - 1) * $elementsNum;

				$sql2 = "select * from arts limit $nowElements,$elementsNum";
				// excute the sql2 to obtain the target page's data
				$artsData2 = mysqli_query($conn, $sql2);

				while ($row = mysqli_fetch_assoc($artsData2)) {
				?>
					<section class="lists">
						<h2><?php echo $row['Item_title'] ?></h2>
						<h3>Installed in: <?php echo $row['Installed'] ?></h3>
						<h3>Artist:<?php echo $row['Artist'] ?></h3>
						<h3>Material: <?php echo $row['Material'] ?></h3>
						<h3>Location: <?php echo $row['The_Location'] ?></h3>
						<p><?php echo $row['Description'] ?></p>
					</section>
				<?php } ?>
				<br><br>
			</section>


			<div class="page-switch">
				<nav>
					<ul class="pagination">
						<li class="page-item disabled" aria-label="&laquo; Previous">
							<a href="information.php?p=<?php if ($p > 1) {
															echo ($p - 1);
														} else echo 1; ?>">&lsaquo;</a>
						</li>
						<?php
						for ($i = 1; $i <= $totalPage; $i++) {
							if ($p == $i) {
								$now = $i;
						?>
								<li class="page-item active">
									<span class="page-link"><?php echo $now; ?></span>
								</li>
							<?php
							} else {
							?>
								<li class="page-item">
									<a class="page-link" href="information.php?p=<?php echo $i; ?>"><?php echo $i; ?></a>
								</li>
						<?php
							}
						}
						?>
						<li class="page-item">
							<a class="page-link" href="information.php?p=<?php if ($p == $totalPage) {
																				echo $now;
																			} else {
																				echo $now + 1;
																			} ?>" rel="next" aria-label="Next &raquo;">&rsaquo;</a>

						</li>
					</ul>
				</nav>
			</div>


			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 

</body>

</html>