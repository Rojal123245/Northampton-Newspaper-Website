<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require 'dbconnect.php';//helps to connect to database
	if (isset($_GET['catid'])) {//getting the value 
		$eeeid = $_GET['catid'];
		
		$rojalstmt = $pdo->prepare("SELECT * FROM categories WHERE category_id=:catid");
		$rojalcriteria = [
			'catid' => $eeeid
		];
		$rojalstmt->execute($rojalcriteria);
		$row99 = $rojalstmt-> fetch();
	}
		if(isset($_POST['addtitle'])){//updating the data
			
		$rojalstmt=$pdo->prepare("UPDATE categories SET
								category_title = :ctitle
								
							WHERE
								category_id = :id
							");
		unset($_POST['addtitle']);
		$result = $rojalstmt->execute($_POST);	
		if($result == true)	{
			echo "Updated";
			header('location:apanel.php');
		}
		else echo "Record Not Updated";
	}
?>
<!-- html starts -->
<head>
<script type="text/javascript"></script>
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
				<nav>
				<ul>
					<li><a href="apanel.php">Add Catagories</a></li><br>
					<li><a href="newspost.php">Add News Article</a></li><br>
					<li><a href="showcomment.php">Comments publish</a></li><br>
					<li><a href="contactinfo.php">Contact info</a></li><br>
					<li><a href="aregister.php">Register</a></li>
					<li><a href="showadmin.php">Registered Admin</a></li>
				</ul>
			</nav>
			<form method="POST" action="editcategory.php">
			<label>Enter category title: </label>
			<input type="hidden" name="id" value="<?php echo $eeeid;?>">
			<input type="text" name="ctitle" value="<?php if(isset($row99['category_title'])) echo $row99['category_title'];?>"><br>
			<input type="submit" name="addtitle" value="Submit">
			</form><br>

		
			</main>
			
			<footer>
			&copy; Northampton News 2017
		</footer>