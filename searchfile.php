<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database
session_start();//session starts
?>

<!-- 
HTML starts -->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
		
	</head>
	<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=1887980364849505';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
					<ul>
					<!-- showing category value -->
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
		
	 <main>
	

			<article>
				<h2>WELCOME TO THE NORTHAMPTON NEWS</h2>
				<p>HEADLINES:</p>
				<ul>
				<?php
					$seav = $_SESSION['usersearch'];//getting data
					$rojalstmt =$pdo->query("SELECT * FROM news WHERE author = '$seav'");//searching data
					$rojalstmt ->execute();
					foreach ($rojalstmt as $row100) {?><!-- displaying data -->
						<li>Title: <?php echo $row100['title'] ?></li>
						<li>author: <?php echo $row100['author'] ?></li>
						<li>Date: <?php echo $row100['postdate'] ?></li>
						<li>Contents: <?php echo $row100['content'] ?></li>
							<li>Category: <?php 
							$stmt1 = $pdo->query('SELECT category_title FROM categories 
								WHERE category_id='.$row100['category_id'].'');
							$stmt1->execute();
							foreach ($stmt1 as $row1) {
								echo $row1['category_title'];
							}
						?></li>
						<li>News: <?php echo $row100['newsmessage'] ?></li>
						
					
						<div class="fb-like" data-href="https://www.facebook.com/Cartoon-Memo-618541421560013/" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div><br><br>

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
