<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
	require 'dbconnect.php';//connecting to database
	session_start();//starting the session
	if(!isset($_SESSION['UserIDvalue'])){//if the user is not login 
	header('location:login.php');//direct to login page
}
	
		if(isset($_POST['save'])){//after the save button is clicked
		$rojalstmt = $pdo->prepare("INSERT INTO 
			contactmessage(contact_message_date, contact_message, users_id)
		VALUES(:contact_message_date, :contact_message, :users_id)");//storing data in database in table contactmessage
		//storing the data got from form
		$rojalcriteria = [
				'contact_message_date' =>date('Y-m-d'),
				'contact_message'=> $_POST['contact_message'],
				'users_id'=> $_POST['users_id'],
		];
		$rojalstmt->execute($rojalcriteria);
		//displaying result in javascript
		echo "<script type='text/javascript'>alert('Contact message is Inserted');</script>";
	}


?>
<!-- HTML starts -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
	<title>contact us</title>
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
				<!-- displaying the category store in database -->
					<ul>
						<?php 
							$stmt1 = $pdo->query('SELECT category_id, category_title FROM categories');//getting data
							$stmt1->execute();
							foreach ($stmt1 as $row1) {//sending value through url
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

<h2>Leave a message </h2>
<form method="POST" action="">

<label id="mess">Message</label>
<textarea name="contact_message" cols="60" rows="5"></textarea><br>
<select id="hid" name="users_id">
<?php
//getting the data of user
$value = $_SESSION['UserIDvalue'];
	$rojalstmt = $pdo->prepare("SELECT * FROM users WHERE id = '$value'");
	$rojalstmt->execute();
	foreach ($rojalstmt as $row100) {
	?>
	
	<option value="<?php echo $row100['id']?>">
		<?php echo $row100['firstname'].' '.$row100['lastname'];?>
	</option>
	
	<?php
	}
?>
	
</select><br><br>
<input  id="ss" type="submit" value="Save" name="save"><br><br>

</form>


</body>

<footer>
			&copy; Northampton News 2017
		</footer>
</html>

