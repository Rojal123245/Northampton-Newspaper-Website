<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require 'dbconnect.php';//connecting to database
session_start();//starting the sessiom
if(isset($_SESSION['UserIDvalue'])){//if the user is already login
	header('loaction:index.php');//direct to mainpage
}

if(isset($_POST['save'])){//when the login button is pressed
	
		$rojalstmt = $pdo->prepare("SELECT * FROM users WHERE email =:email");//getting data
		$criteria = [
				'email' =>$_POST['email'],
				
		];
		$chec = false;
		
		$rojalstmt->execute($criteria);
		if($rojalstmt->rowCount() > 0){
			$user99 = $rojalstmt->fetch();
			if(password_verify($_POST['password'], $user99['password'])){//checking whether the password is correct or not
			$_SESSION['UserIDvalue'] = $user99['id'];//storing in session
			header('location:index.php');//direct to main page
		}
		else{
			$chec = true;
		}
		}
	
		else{ 
			$chec= true;
		}
		if($chec == true){
			echo "<script type='text/javascript'>alert('Error log in failed');</script>";
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
<h2>Login here</h2>
<form method="POST" action="">
	<label>E-mail</label>
	<input type="text" name="email" required><br><br>
	<label>Password</label>
	<input type="Password" name="password" required><br><br>
	<input type="submit" id="ss" name="save" value="Login">
	
</form>
</fieldset>
<footer>
	&copy; Northampton News 2017
</footer>
<h3>Register here</h3>
<a href="loginregister.php">register</a>