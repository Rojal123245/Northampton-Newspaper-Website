<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database
session_start();//starting the database

if(!isset($_SESSION['sessaUserID'])){//if the user is not login 
	header('location:admlogin.php');//direct to login page
}




?>


<!-- html starts -->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
		

	</head>
	<body>
<!-- for the fb like button -->
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
				<li><a href="apanel.php">Admin panel</a></li>
				
				
				<li><a href="nloggingout.php">Log out</a></li>

			</ul>
		</nav>
		<img src="../images/banners/randombanner.php" />
	 <main>
			


			<article>
				<h2>WELCOME TO THE NORTHAMPTON NEWS</h2>
				<p>HEADLINES:</p>
				<ul>
				<?php

					$rojalstmt =$pdo->query("SELECT * FROM news ORDER BY postdate DESC");//query the news in desc order
					$rojalstmt ->execute();
					foreach ($rojalstmt as $rojalrow) {?><!-- displaying the news -->
						<li>Title: <?php echo $rojalrow['title'] ?></li>
						<li>author: <?php echo $rojalrow['author'] ?></li>
						<li>Date: <?php echo $rojalrow['postdate'] ?></li>
						<li>Contents: <?php echo $rojalrow['content'] ?></li>
							<li>Category: <?php 
							$stmt1 = $pdo->query('SELECT category_title FROM categories 
								WHERE category_id='.$rojalrow['category_id'].'');
							$stmt1->execute();
							foreach ($stmt1 as $row1) {
								echo $row1['category_title'];
							}
						?></li>
						<li>News: <?php echo $rojalrow['newsmessage'] ?></li>
						
						<?php $_SESSION['newsv'] = $rojalrow['news_id']; ?>
						<li><a href="aeditnews.php?eid=<?php echo $rojalrow['news_id'];?>">Edit</a> | <a href="aeditnews.php?did=<?php echo $rojalrow['news_id'];?>">Delete</a></li>
						<!-- for the db like and share button -->
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
