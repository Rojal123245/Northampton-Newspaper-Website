<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require 'dbconnect.php';//connecting to database
session_start();//starting the session to get the value
if(!isset($_SESSION['sessaUserID'])){//if the user is not login 
	header('location:admlogin.php');//direct to login page
}
if(isset($_POST['post'])){
$rojalstmt = $pdo->prepare("INSERT INTO 
			news(newsmessage, category_id, title, author, content, postdate)
		VALUES(:newsmessage, :scategory, :title, :authorn, :content, :postdate)");//inserting to the news database
	//storing the value given from the form
	$rojalcriteria = [
				
				'newsmessage'=> $_POST['newsmessage'],
				'scategory'=> $_POST['scategory'],
				'title'=> $_POST['title'],
				'authorn'=>$_POST['authorn'],
				'content'=>$_POST['content'],
				'postdate'=>date('Y-m-d'),
		];
		$rojalstmt->execute($rojalcriteria);
		echo "<script type='text/javascript'>alert('News Inserted');</script>";
}
?>
<!-- HTML starts -->
<head>
		<link rel="stylesheet" type="text/css" href="style.css">
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
				<li><a href="apanel.php">Admin panel</a></li>
				
				
				<li><a href="nloggingout.php">Log out</a></li>

			</ul>
		</nav>
			<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				<ul>
					<li><a href="apanel.php">Add Catagories</a></li>
					<li><a href="newspost.php">Add News Article</a></li>
					<li><a href="showcomment.php">Comment publish</a></li>
					<li><a href="contactinfo.php">Contact info</a></li>
					<li><a href="aregister.php">Register</a></li>
					<li><a href="showadmin.php">Registered Admin</a></li>
				</ul>
			</nav>
			<form method="POST" action="">
	<label>Enter the title:</label>
	<input type="text" name="title"><br><br>
	<label>Enter author name:</label>
	<input type="text" name="authorn"><br>
	<label>enter the content: </label>
	<input type="text" name="content"><br>
	<label>Select Category</label>
		<select name="scategory">
		<?php 
			$stmt1 = $pdo->query('SELECT category_id, category_title FROM categories');
			$stmt1->execute();
			foreach ($stmt1 as $row1) {
					echo '<option value="'.$row1['category_id'].'">'.$row1['category_title'].'</option>';
				}
		?>
	</select><br>
		
	
	<label>Enter the news</label>
	<textarea rows="6" cols="60" name="newsmessage"></textarea><br>
	<input id="sss" type="submit" name="post" value="Post">
</form>
			</main>


	<footer>
			&copy; Northampton News 2017
		</footer>