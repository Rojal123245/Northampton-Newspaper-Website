<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require'dbconnect.php';//connecting to the database
session_start();//starting the session
if(!isset($_SESSION['sessaUserID'])){//if the user is not login
	header('location:admlogin.php');//direct to login page
}
if (isset($_GET['eid'])) {//edit the admin data
		$eid = $_GET['eid'];
		$rojalstmt = $pdo->prepare("SELECT * FROM admintable WHERE admin_id=:eid");
		$rcriteria = [
			'eid' => $eid
		];
		$rojalstmt->execute($rcriteria);
		$row50 = $rojalstmt-> fetch();
	}
if(isset($_POST['register'])){//updating the data
		$rojalstmt=$pdo->prepare("UPDATE admintable SET
								fullname = :adminname,
								username = :adminusername
							WHERE
								admin_id = :id
							");
		unset($_POST['register']);
		$rresult = $rojalstmt->execute($_POST);	
		if($rresult == true)	{
			echo "<script type='text/javascript'>alert('Record Updated');</script>";
			header('location:showadmin.php');
		}
		else echo "<script type='text/javascript'>alert('Record Not Updated');</script>";
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
					<li><a href="#">Add Catagories</a></li><br>
					<li><a href="newspost.php">Add News Article</a></li><br>
					<li><a href="#">Delete comments</a></li><br>
					<li><a href="contactinfo.php">Contact info</a></li><br>
					<li><a href="aregister.php">Register</a></li>
					<li><a href="showadmin.php">Registered Admin</a></li>
				
				</ul>
			</nav>
			<!-- form started -->
				<form method="POST" action="editadmin.php">
				<input type="hidden" name="id" value="<?php echo $eid;?>">
				<label>Full Name: </label>
				<input type="text" name="adminname" value="<?php if(isset($row50['fullname'])) echo $row50['fullname'];?>"><br><!-- displaying the data in the database -->
				<label>Username: </label>
				<input type="text" name="adminusername" value="<?php if(isset($row50['username'])) echo $row50['username'];?>"><br>
				
				<input type="submit" name="register" value="Register">
			</form>
	
			</main>
		
			</body>
			
			<footer>
			&copy; Northampton News 2017
		</footer>
		