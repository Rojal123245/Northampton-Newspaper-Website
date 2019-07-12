<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connect to the database
?>


<!-- HTML starts -->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="Larti.php">Latest Articles</a></li>
				<li><a href="">Select Category</a>
				<!-- displaying the category of the database -->
					<ul>
						<?php 
							$stmt1 = $pdo->query('SELECT category_id, category_title FROM categories');
							$stmt1->execute();
							foreach ($stmt1 as $row1) {
								?>
								<li>
								<?php
								echo '<a href="busi.php?cId='.$row1['category_id'].'">'.$row1['category_title'].'</a>';
								?>
								</li>
								<?php
							}
						?>
					</ul>
				</li>
				<li><a href="contact.php">Contact us</a></li>
				<li><a href="profiles.php">My Profile</a></li>
				<li><a href="nloggingout.php">Log out</a></li>

			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
	 <main>
		

			<article>
				<h2>WELCOME TO THE NORTHAMPTON NEWS</h2>
				<p>NEWS</p>
				<ul>
				<?php
					$categoryvalue = $_GET['cId'];
					
					$rojalstmt =$pdo->query("SELECT * FROM news WHERE category_id = $categoryvalue");//query of database
					
					$rojalstmt ->execute();
					foreach ($rojalstmt as $row100) {?><!-- displaying values -->
						<li>Title: <?php echo $row100['title'] ?></li>
						<li>author: <?php echo $row100['author'] ?></li>
						<li>Date: <?php echo $row100['postdate'] ?></li>
						<li>Contents: <?php echo $row100['content'] ?></li>
						<li>News: <?php echo $row100['newsmessage'] ?></li><br><br>


					<?php }
				?>
				</ul>

			</article>
		</main>

		<footer>
			&copy; Northampton News 2017
		</footer>

	</body>
</html>