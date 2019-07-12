<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database

session_start();
if(!isset($_SESSION['sessaUserID'])){//check if the user is login or not
	header('location:admlogin.php');//if not direct him/her to login page
}
	if (isset($_GET['eid'])) {//to edit the news
		$eid = $_GET['eid'];//storing data that was send through URL
		$rojalstmt = $pdo->prepare("SELECT * FROM news WHERE news_id=:eid");//getting data from database
		$rojalcriteria = [
			'eid' => $eid
		];
		$rojalstmt->execute($rojalcriteria);//executing data
		$row49 = $rojalstmt-> fetch();
	}
	if(isset($_GET['did'])){//to delete the news
		$rojalstmt = $pdo->prepare("DELETE FROM news WHERE news_id = :did");//delete database code 
		$rojalcriteria = [ 'did' => $_GET['did']];
		$result = $rojalstmt->execute($rojalcriteria);
		if($result){
			echo "<script type='text/javascript'>alert('Delete successful');</script>";
		header('location:index.php');
	}
		else
		echo "<script type='text/javascript'>alert('Delete not successful');</script>";
	}
	if(isset($_POST['post'])){//updating the data of news
		$rojalstmt=$pdo->prepare("UPDATE news SET
								title = :title,
								author = :authorn,
								content = :content,
								category_id = :scategory,
								newsmessage = :newsmessage
							WHERE
								news_id = :id
							");
		unset($_POST['post']);
		$result = $rojalstmt->execute($_POST);	
		if($result == true)	{
			echo "Updated";
			header('location:index.php');
		}
		else echo "Record Not Updated";
	}
?>
<!-- html starts -->
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
					<li><a href="#">Add Catagories</a></li>
					<li><a href="newspost.php">Add News Article</a></li>
					<li><a href="#">Delete comments</a></li>
					<li><a href="contactinfo.php">Contact info</a></li>
					<li><a href="aregister.php">Register</a></li>
				</ul>
			</nav>
			<form method="POST" action="aeditnews.php">
			<input type="hidden" name="id" value="<?php echo $eid;?>">
	<label>Enter the title:</label>
	<input type="text" name="title" value="<?php if(isset($row49['title'])) echo $row49['title'];?>"><br><br><!-- displaying values store in database -->
	<label>Enter author name:</label>
	<input type="text" name="authorn" value="<?php if(isset($row49['author'])) echo $row49['author'];?>"><br>
	<label>enter the content: </label>
	<input type="text" name="content" value="<?php if(isset($row49['content'])) echo $row49['content'];?>"><br>
	<label>Select Category: </label>
	<select name="scategory"><!-- getting the category data -->
		<?php 
			$stmt1 = $pdo->query('SELECT category_id, category_title FROM categories');
			$stmt1->execute();
			foreach ($stmt1 as $row1) {
					echo '<option value="'.$row1['category_id'].'">'.$row1['category_title'].'</option>';
				}
		?>
	</select><br>
		
	
	<label>Enter the news</label>
	<textarea rows="6" cols="60" name="newsmessage"><?php if(isset($row49['newsmessage'])) echo $row49['newsmessage'];?></textarea><br>
	<input id="sss" type="submit" name="post" value="Post">
</form>
			</main>


	<footer>
			&copy; Northampton News 2017
		</footer>