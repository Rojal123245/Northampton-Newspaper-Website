<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database
session_start();//starting the session


if(isset($_POST['post'])){//to insert the comment
	if(!isset($_SESSION['UserIDvalue'])){//checking if the user is login or not
	header('location:login.php');//if not direct to login page
}
	else{
		$rojalstmt = $pdo->prepare("INSERT INTO 
		                   commentsections(cmtmessage,cmtdate, users_id)
		                   VALUES(:comment,:cmtdate,:users_id)");//inserting data
		//storing the data got from form
	$rojalcriteria = [
	'comment' =>$_POST['comment'],
	'cmtdate' =>date('Y-m-d'),
	'users_id' =>$_SESSION['UserIDvalue']
	
	];
	$rojalstmt->execute($rojalcriteria);
		echo "<script type='text/javascript'>alert('Comment Inserted');</script>";
//helps to send the email to the users
/*$newsto = "rozalpra@gmail.com";
$newssubject = "Northampton news";
$cmt = "thank you for comment";
$values = $_SESSION['UserIDvalue'];
$useremail = $pdo->query("SELECT email FROM users WHERE id = '$values'");

foreach ($useremail as $key10 =>$v) {
	
mail($newsto,$newssubject,$cmt,$v['email']);
}*/

}

}

if(isset($_POST['search'])){//to search the information

	$_SESSION['usersearch'] = $_POST['newssearch'];
	header('location:searchfile.php');
}


?>


<!-- HTML starts -->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
		<!-- search form -->
		<form method="POST" action="">
		<input type="text" name="newssearch" id="se" placeholder="search news author">
		<input type="submit" id="sea" name="search" value="Search">
		</form>
	</head>
	<body>
<!-- for fb like and share button -->
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
				<!-- displaying the data of category -->
					<ul>
						<?php 
							$stmt1 = $pdo->query('SELECT category_id, category_title FROM categories');
							$stmt1->execute();
							foreach ($stmt1 as $row1) {
								?>
								<li>
								<?php
								//sending value through url
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
				<p>HEADLINES:</p>
				<ul>
				<?php

					$rojalstmt =$pdo->query("SELECT * FROM news ORDER BY postdate DESC");
					$rojalstmt ->execute();
					foreach ($rojalstmt as $row) {?><!-- displaying the news -->
						<li>Title: <?php echo $row['title'] ?></li>
						<li>author: <?php echo $row['author'] ?></li>
						<li>Date: <?php echo $row['postdate'] ?></li>
						<li>Contents: <?php echo $row['content'] ?></li>
						<li>Category: <?php 
							$stmt1 = $pdo->query('SELECT category_title FROM categories 
								WHERE category_id='.$row['category_id'].'');
							$stmt1->execute();
							foreach ($stmt1 as $row1) {
								echo $row1['category_title'];
							}
						?></li>
						<li>News: <?php echo $row['newsmessage'] ?></li>
						
						<!-- for fb like and share button -->
						<div class="fb-like" data-href="https://www.facebook.com/Cartoon-Memo-618541421560013/" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div><br><br>

					<?php }
				?>
				<br>
				<br>
				<!-- user comment section -->
				<fieldset>
				<label id="cs">Comments</label>
								<?php


					$rojal = $pdo->query("SELECT cmt_id,firstname, lastname, cmtmessage, cmtdate,display FROM users JOIN commentsections AS cmt ON users.id  = cmt.users_id");//getting data of comments
					
					$rojal ->execute();
					
					foreach ($rojal as $row100){
						if($row100['display'] == 'Y'){
						?>

					<form method="POST" action="showcomment.php">
						<input type="hidden" name="cmid" value="<?php echo $row100['cmt_id'] ?>">
					</form>
					<!-- displaying the comments -->
					<li>Full name: <?php echo $row100['firstname'].' '.$row100['lastname']?></li>
					<li>Date: <?php echo $row100['cmtdate']?></li>
					<li>Comment: <?php echo $row100['cmtmessage']?></li>
					
						<br>
						<br>
				<?php }

					}
				?>
				
				</fieldset>
				</ul>
				<form method="POST" action="">
				<label>Comment section</label>
				
				<textarea placeholder="Add a comment" name="comment" rows="6" cols="60"></textarea><br>
						<input type="submit" id="sss" name="post" value="Post"><br><br>
			</form>
			
			
			</article>
		</main>


		<footer>
			<p>&copy; Northampton News 2017</p>
		</footer>

	</body>
</html>
