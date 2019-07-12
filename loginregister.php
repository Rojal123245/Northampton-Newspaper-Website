<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require 'dbconnect.php';//database connected


if(isset($_POST['register'])){//to register new user
	if($_POST['Firstname']=="" || $_POST['Lastname']=="" || $_POST['Password']=="" || $_POST['Email']=="" ||$_POST['cno']=="" ||$_POST['Gender']=="" ||$_POST['dob']==""){
			echo "<script type='text/javascript'>alert('please fill all the details');</script>";
	}
		else {
			$rojalstmt = $pdo->prepare("INSERT INTO users(firstname,lastname, password, email, Nationality, contactno, gender, dateofbirth)
								VALUES(:Firstname,:Lastname, :Password, :Email, :nation, :cno, :Gender, :dob)");
		//storing data of the form
		$rojalcriteria =[
		'Firstname'=> $_POST['Firstname'],
		'Lastname'=> $_POST['Lastname'],
		'Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT),
		'Email' => $_POST['Email'],
		'nation' => $_POST['nation'],
		'cno'=> $_POST['cno'],
		'Gender' => $_POST['Gender'],
		'dob' => $_POST['dob']
		];
		$rojalstmt->execute($rojalcriteria);
		//displaying the result
		echo "<script type='text/javascript'>alert('Inserted Succesful');</script>";
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
<fieldset>

<form action="" method="POST">
<label id="fname">First name:</label>
<input type="text"  name="Firstname" placeholder="  your First name"><br><br>
<label id="lname">Last name:</label>
<input type="text"  name="Lastname" placeholder=" your last name"><br><br>
<label id="pw">Password</label>
<input type="password"  name="Password" placeholder=" your password"><br><br>
<label id="em">E-mail</label>
<input type="text"  name="Email" placeholder=" your Email id"><br><br>
<label id="nn">Nationality:</label>
<select name="nation" id="choosecountry">
	<option>Nepal</option>
	<option>United Kingdom</option>
	<option>United States</option>
	<option>India</option>
	<option>Pakistan</option>
	<option>China</option>
</select><br><br>
<label id="cn">Contact no:</label>
<input type="text"  name="cno" placeholder=" your Contact number"><br><br>
<label id="g">Gender:</label>

<input type="radio" name="Gender" value="Male" >Male
<input type="radio" name="Gender" value="Female">Female<br><br>

<label id="dob">Date of Birth</label>
<input type="Date"  name="dob"><br><br>

<input type="submit" id="ss" name="register" value="Submit">
	
</form>

</fieldset>
<footer>
			&copy; Northampton News 2017
		</footer>

		<h3>login here</h3>
		<a href="login.php">Login</a>
