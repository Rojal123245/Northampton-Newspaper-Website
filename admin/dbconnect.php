<!-- UNID: 17425095 Name:Rojal pradhan --> 
<!-- helps to connect to the database -->
<?php
$host = 'localhost'; $db = 'assignment'; $user ='root'; $pass = '';
	$pdo = new PDO('mysql:dbname='.$db.';host='.$host, $user, $pass);
	?>