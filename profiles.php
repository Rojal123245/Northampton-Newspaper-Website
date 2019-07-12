<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require 'dbconnect.php';//connecting to database

session_start();//starting the session
if(!isset($_SESSION['UserIDvalue'])){//if the user is not login 
	header('location:login.php');//direct to loginpage
}
	if(isset($_GET['did'])){//delete the user
		$rojalstmt = $pdo->prepare("DELETE FROM users WHERE id = :did");
		$rojalcriteria = [ 'did' => $_GET['did']];
		$rojalresult = $stmt->execute($rojalcriteria);
		if($result){
			echo "<script type='text/javascript'>alert('delete successful');</script>";
		
		header('location:login.php');
	}
		else
			echo "<script type='text/javascript'>alert('Not Deleted');</script>";
	}
	if(isset(($_POST['edit']))){//editing the user data
		
		$edit = $_POST['edit'];
		$value = $_SESSION['UserIDvalue'];
		$records = $pdo->query("SELECT * FROM users WHERE id= '$value'");
		foreach($records as $edit =>$row7){//sending the data through url
			echo '<a href="editcontact.php?eid='.$row7['id'].'">Edit</a> | <a href="ex1.php?did='.$row7['id'].'">Delete</a>';
		}
	}
	

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
					<!-- showing the category data -->
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
	
	 <main>
	

			<article>

				<h2>WELCOME TO THE NORTHAMPTON NEWS USER PROFILES</h2>
				<p>Your Profile</p>
				<ul>
				<?php
					
					$valu = $_SESSION['UserIDvalue'];
					$rojalstmt =$pdo->query("SELECT * FROM users WHERE id = '$valu'");//getting user data
					$rojalstmt ->execute();
					foreach ($rojalstmt as $row100) {?><!-- displaying user data -->
						<label>First Name</label>
						<li><?php echo $row100['firstname'] ?></li>
						<label>Last Name</label>
						<li> <?php echo $row100['lastname'] ?></li>
						 <label>Email</label>
						<li><?php echo $row100['email'] ?></li>
						<label>Nationality</label>
						<li> <?php echo $row100['nationality'] ?></li>
						<label>Contact Number</label>
						<li> <?php echo $row100['contactno'] ?></li>
						<label>Gender</label>
						<li> <?php echo $row100['gender'] ?></li>
						<label>Date of Birth</label>
						<li> <?php echo $row100['dateofbirth'] ?></li><br>
					

					<?php }
				?>
				</ul>
			<form method="POST" action="">
			<input id="ss" type="submit" name="edit" value="Edit">
			<input  id="ss" type="submit" name="delete" value="Deactivate">
			</form>
			


			
			</article>
			
		</main>

		</body>
		<footer>
			&copy; Northampton News 2017
		</footer>

	</body>
</html>
