<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php 
require 'dbconnect.php';//connecting to database
	if (isset($_GET['eid'])) {//getting value from url
		$eid = $_GET['eid'];
		$rojalstmt = $pdo->prepare("SELECT * FROM users WHERE id=:eid");
		$rojalcriteria = [
			'eid' => $eid
		];
		$rojalstmt->execute($rojalcriteria);
		$row50 = $rojalstmt-> fetch();
	}
	if(isset($_POST['register'])){//updating the data
		$rojalstmt=$pdo->prepare("UPDATE users SET
								firstname = :Firstname,
								lastname = :Lastname,
								email = :Email,
								nationality = :nation,
								contactno = :cno,
								gender = :Gender,
								dateofbirth = :dob
							WHERE
								id = :id
							");//editing the data
		unset($_POST['register']);
		$result = $rojalstmt->execute($_POST);	
		if($result == true)	{
			echo "<script type='text/javascript'>alert('Record Updated');</script>";
			header('location:profiles.php');
			
		}
		else echo "<script type='text/javascript'>alert('Record nOT Updated');</script>";
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
<fieldset>
<!-- diplaying the data of a particular contact  -->
<form action="editcontact.php" method="POST">
<input type="hidden" name="id" value="<?php echo $eid;?>">
<label id="fname">First name:</label>

<input type="text"  name="Firstname" placeholder="  your First name" value="<?php if (isset($row50['firstname'])) echo $row50['firstname'];?>"><br><br>
<label id="lname">Last name:</label>
<input type="text"  name="Lastname" placeholder=" your last name" value="<?php if (isset($row50['lastname'])) echo $row50['lastname'];?>"><br><br>

<label id="em">E-mail</label>
<input type="text"  name="Email" placeholder=" your Email id" value="<?php if (isset($row50['email'])) echo $row50['email'];?>"><br><br>
<label id="nn">Nationality:</label>
<select name="nation" id="choosecountry" value="<?php if (isset($row50['nationality'])) echo $row50['nationality'];?>">
	<option>Nepal</option>
	<option>United Kingdom</option>
	<option>United States</option>
	<option>India</option>
	<option>Pakistan</option>
	<option>China</option>
</select><br><br>
<label id="cn">Contact no:</label>
<input type="text"  name="cno" placeholder=" your Contact number" value="<?php if (isset($row50['contactno'])) echo $row50['contactno'];?>"><br><br>
<label id="g">Gender:</label>

<input type="radio" name="Gender" value="Male" checked >Male
<input type="radio" name="Gender" value="Female" <?php if(isset($row50['gender'])){ if($row50['gender'] == 'Female'){ echo 'checked'; }}?>>Female<br><br>

<label id="dob">Date of Birth</label>
<input type="Date"  name="dob" value="<?php if (isset($row50['dateofbirth'])) echo $row50['dateofbirth'];?>"><br><br>

<input type="submit" id="ss" name="register" value="Submit">
	
</form>

</fieldset>
<footer>
			&copy; Northampton News 2017
		</footer>
