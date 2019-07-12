<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database
session_start();//starting the session
if(!isset($_SESSION['sessaUserID'])){//checking if the user is login or not
	header('location:admlogin.php');//if not directing to login page
}
if(isset($_POST['edit'])){//to edit the category
	$Categoryedit = $_POST['getcategory'];
		$edit = $_POST['edit'];
	
		$records = $pdo->query("SELECT * FROM categories WHERE category_id= $Categoryedit");//query to get data
		foreach($records as $edit =>$row10){
			echo '<a href="editcategory.php?catid='.$row10['category_id'].'">Edit</a>';//sending value to next page
		}
	
}


if(isset($_POST['addtitle'])){//adding new category
	$rojalstmt = $pdo->prepare("INSERT INTO categories(category_title)
									VALUES(:ctitle)");//inserting into the database
	$rojalcriteria = [
	'ctitle' =>$_POST['ctitle']
	];
	$rojalstmt->execute($rojalcriteria);
	if($rojalstmt==true){echo "<script type='text/javascript'>
		alert('Category added');
		</script>";}//displaying the result through javascript
	else {echo "<script type='text/javascript'>alert('Category not added');</script>";}
}

if(isset($_POST['delete'])){//to delete the category
$cid = $_POST['getcategory'];//getting the value and storing in a variable

$contact = $pdo->prepare("DELETE FROM categories WHERE categories.category_id=$cid");//deleting the categories from database
unset($_POST['delete']);
$cresult= $contact->execute($_POST);
print_r($contact->fetch());
if($cresult==true)
	echo "<script type='text/javascript'>alert('Deleted');</script>";
else
	echo "<script type='text/javascript'>alert('Not deleted');</script>";
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
			<form method="POST">
			<label>Enter category title: </label>
			<input type="text" name="ctitle"><br>
			<input type="submit" name="addtitle" value="Submit">
			</form><br>
			<!-- displaying the categories in the database -->
			<table id="nth" border="2">
	<thead>
		<tr>
			<th>SN</th>
			<th>Category name</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$rojalstmt = $pdo->prepare("SELECT category_id, category_title FROM categories");//getting the id and title of category
			$sn = 1;
			$rojalstmt->execute();
			
			foreach ($rojalstmt as $rojalrow) { ?>
			<tr>
				<td><?php echo $sn++;?></td>
				<td><?php echo $rojalrow['category_title'];?></td>
				

				
				<form method="POST" action="apanel.php">
				<input type="hidden" name="getcategory" value="<?php echo $rojalrow['category_id'];?>">
				<td><input type="submit" id="ssss" name="edit" value="edit"></td>
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