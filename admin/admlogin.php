<!-- UNID: 17425095 Name:Rojal pradhan --> 
<?php
require 'dbconnect.php';//connecting to the database
session_start();//starting the session to get the value
if(isset($_SESSION['sessaUserID'])){//storing the userid in a session
	header('loaction:index.php');//directing to the next page
}

if(isset($_POST['login'])){//after the login button is pressed
	
		$rojalstmt = $pdo->prepare("SELECT * FROM admintable WHERE username =:ausern");//taking user data
		$rojalcriteria = [
				'ausern' =>$_POST['ausern']
				
		];
		$che = false;//bollean
		
		$rojalstmt->execute($rojalcriteria);
		if($rojalstmt->rowCount() > 0){//if the value from the $rojalstml be more than 0 the condition becomes true
			$auser = $rojalstmt->fetch();//fetching the data
		
			if(password_verify($_POST['apass'], $auser['password'])){//looking if the password is correct or not
			$_SESSION['sessaUserID'] = $auser['admin_id'];//if true then storing the user id in session
			header('location:index.php');//to the next page
		}
		else{
			$che = true;
		}
		}

		else{
			$che = true;
		}
		if($che = true){//if the email or password is wrong 
			echo "<script type='text/javascrip'>alert('Login failed');</script>";
		}
}
?>
<!-- form starts -->
<link rel="stylesheet" type="text/css" href="style.css">
<div id="alog">
<h3>Admin Login</h3>
<fieldset>
<form method="POST" action="">
<h2>Northampton news</h2>
<label>Username: </label>
<input type="text" name="ausern" required>
<br><br>
<label>Password: </label>
<input type="Password" name="apass" required>
<input type="submit" id="admi" name="login" value="Login">
</form>
</fieldset>
</div>