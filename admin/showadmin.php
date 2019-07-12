<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require'dbconnect.php';//connecting to databse
?>
<?php 
session_start();//starting the session value
if(!isset($_SESSION['sessaUserID'])){//if the user isnot login 
	header('location:admlogin.php');//direct to login page
}
if(isset($_POST['delete'])){//to delete the admin 
$cid = $_POST['getadmin'];

$contact = $pdo->prepare("DELETE FROM admintable WHERE admin_id = $cid");
unset($_POST['delete']);
$cresult= $contact->execute($_POST);
print_r($contact->fetch());
if($cresult==true)
	echo "<script type='text/javascript'>alert('admin Deleted');</script>";
else
	echo "<script type='text/javascript'>alert('admin Not Deleted');</script>";
}

if(isset($_POST['edit'])){//editing the admin data
	
	$edit = $_POST['edit'];
		$value = $_POST['getadmin'];
		$records = $pdo->query("SELECT * FROM admintable WHERE admin_id= $value");
		foreach($records as $edit =>$row){
			echo '<a href="editadmin.php?eid='.$row['admin_id'].'">Edit</a>';
		}
	
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
	<!-- displaying value of admin in table -->		
<table id="ta" border="2">
	<thead>
		<tr>
			<th>SN</th>
			<th>Full name</th>
			<th>username</th>
			<th>EDIT</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$rojalstmt = $pdo->prepare("SELECT admin_id, fullname, username FROM admintable");//getting the value from database
			$sn = 1;
			$rojalstmt->execute();
			
			foreach ($rojalstmt as $rojalrow) { ?><!-- displaying the data -->
			<tr>
				<td><?php echo $sn++;?></td>
				<td><?php echo $rojalrow['fullname'];?></td>
				<td><?php echo $rojalrow['username'];?></td>
				<form method="POST" action="showadmin.php">

				<input type="hidden" name="getadmin" value="<?php echo $rojalrow['admin_id'];?>">
				<td><input type="submit" id="ssss" name="edit" value="EDIT"></td>
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