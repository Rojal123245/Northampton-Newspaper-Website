<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database
session_start();//starting the session
if(!isset($_SESSION['sessaUserID'])){//if the user isnot login 

	header('location:admlogin.php');//direct to login page
}
if(isset($_POST['submit'])){//updating the data
$commentv = $_POST['cmtid'];
$rojalstmt = $pdo->prepare("UPDATE commentsections SET display = :publish WHERE cmt_id = :cmtid");
	unset($_POST['submit']);
		$result100 = $rojalstmt->execute($_POST);	
		if($result100 == true)	{
			echo "<script type='text/javascript'>alert('Comment displayed');</script>";
			header('location:index.php');
		}
		else echo "<script type='text/javascript'>alert('Comment NOT displayed');</script>";
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
					<li><a href="apanel.php">Add catagories</a></li>
					<li><a href="newspost.php">Add news articles</a></li>
					<li><a href="showcomment.php">Comment publish</a></li>
					<li><a href="contactinfo.php">contact info</a></li>
					<li><a href="aregister.php">Register</a></li>
					<li><a href="showadmin.php">Registered Admin</a></li>
				</ul>
			</nav>
	<!-- displaying data in table -->		
<table id="ta" border="2">
	<thead>
		<tr>
			<th>SN</th>
			<th>name</th>
			<th>Email</th>
			<th>Comment detail</th>
			<th>Comment date</th>
			<th>Publish value</th>
			<th>Option</th>
			<th>Publish</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$rojalstmt = $pdo->prepare("SELECT  cmt_id, firstname, lastname, email, cmtmessage, cmtdate, display FROM users
			 JOIN commentsections ON users.id = commentsections.users_id");//getting data
			$sn = 1;
			$rojalstmt->execute();
			
			foreach ($rojalstmt as $rojalrow) { //displaying data
				if($rojalrow['display'] == 'N'){ ?>
			<tr>
				<td><?php echo $sn++;?></td>
				<td><?php echo $rojalrow['firstname'].' '.$rojalrow['lastname'] ?></td>
				<td><?php echo $rojalrow['email'];?></td>
				<td><?php echo $rojalrow['cmtmessage'];?></td>
				<td><?php echo $rojalrow['cmtdate'];?></td>
				<td><?php echo $rojalrow['display'];?></td>
				
				<form method="POST">
				<input type="hidden" name="cmtid" value="<?php echo $rojalrow['cmt_id'];?>">
				<td><input type="radio" name="publish" value="Y">Yes
				<input type="radio" name="publish" value="N">No</td>
				<td><input type="submit" id="ssss" name="submit" value="publish">
				</form>
				
			</tr>
			
				<?php	} 
			}
			?>
	</tbody>
</table>
			</main>

	<footer>
			&copy; Northampton News 2017
		</footer>