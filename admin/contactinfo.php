<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database


?>
<?php 
session_start();//starting the session 
if(!isset($_SESSION['sessaUserID'])){//if the user not login 
	header('location:admlogin.php');//direct to login page
}
if(isset($_POST['delete'])){//deleting the message
$cid = $_POST['getemail'];

$contact = $pdo->prepare("DELETE FROM contactmessage WHERE contactmessage.id=$cid");
unset($_POST['delete']);
$cresult= $contact->execute($_POST);
print_r($contact->fetch());
if($cresult==true)
	echo "<script type='text/javascript'>alert('Delete successful');</script>";
else
	echo "<script type='text/javascript'>alert('Delete not successful');</script>";
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
			
			<nav>
				<ul>
					<li><a href="apanel.php">Add catagories</a></li>
					<li><a href="newspost.php">Add news articles</a></li>
					<li><a href="showcomment.php">Comment publish</a></li>
					<li><a href="contactinfo.php">contact info</a></li>
					<li><a href="aregister.php">Register</a></li>
					<li><a href="showadmin.php">Registered Admin</a></li>
				</ul>
			</nav>
<!-- displaying the value of contact message  in table -->	
<table id="ta" border="2">
	<thead>
		<tr>
			<th>SN</th>
			<th>name</th>
			<th>Email</th>
			<th>Nationality</th>
			<th>gender</th>
			<th>message detail</th>
			<th>message content</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$rojalstmt = $pdo->prepare("SELECT contactmessage.id AS messageid, firstname, lastname, email, nationality, gender, contact_message_date, contact_message FROM users
			 JOIN contactmessage ON users.id = contactmessage.users_id");//getting the data of contactmessage
			$sn = 1;
			$rojalstmt->execute();
			
			foreach ($rojalstmt as $rojalrow) { ?><!-- displaying the data of contactmessage -->
			<tr>
				<td><?php echo $sn++;?></td>
				<td><?php echo $rojalrow['firstname'].' '.$rojalrow['lastname'] ?></td>
				<td><?php echo $rojalrow['email'];?></td>
				<td><?php echo $rojalrow['nationality'];?></td>
				<td><?php echo $rojalrow['gender'];?></td>
				<td><?php echo $rojalrow['contact_message_date'];?></td>
				<td><?php echo $rojalrow['contact_message'];?></td>

				
				<form method="POST" action="contactinfo.php">
				<input type="hidden" name="getemail" value="<?php echo $rojalrow['messageid'];?>">
				<td><input type="submit" id="ssss" name="delete" value="Delete"></td>
				</form>
				
			</tr>
			
				<?php		}
			?>
	</tbody>
</table>
			</main>

	<footer>
			&copy; Northampton News 2017
		</footer>