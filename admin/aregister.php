<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to the database
if(isset($_POST['register'])){//after the register button is clicked
		$rojalstmt = $pdo->prepare ("INSERT INTO admintable(fullname,username, password)
								VALUES(:adminname,:adminusername, :adminpassword)");//inserting into the database
//storing the data given by user
		$rojalcriteria =[
		'adminname'=> $_POST['adminname'],
		'adminusername'=> $_POST['adminusername'],
		'adminpassword' => password_hash($_POST['adminpassword'], PASSWORD_DEFAULT),
	
		];
		$rojalstmt->execute($rojalcriteria);
		echo "<script type='text/javascript'>alert('Insert successful');</script>";
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
				<nav>
				<ul>
					<li><a href="apanel.php">Add Catagories</a></li><br>
					<li><a href="newspost.php">Add News Article</a></li><br>
					<li><a href="showcomment.php">Comment publish</a></li><br>
					<li><a href="contactinfo.php">Contact info</a></li><br>
					<li><a href="aregister.php">Register</a></li>
					<li><a href="showadmin.php">Registered Admin</a></li>
				</ul>
			</nav>
				<form method="POST" action="">
				<label>Full Name: </label>
				<input type="text" name="adminname" required><br>
				<label>Username: </label>
				<input type="text" name="adminusername" required><br>
				<label>Password: </label>
				<input type="Password" name="adminpassword" required><br>
				<input type="submit" name="register" value="Register">
			</form>
	
			</main>
		
			</body>
			
			<footer>
			&copy; Northampton News 2017
		</footer>