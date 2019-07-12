<!-- UNID: 17425095 Name:Rojal pradhan --> 
<!-- deleting all session value and directing to login page -->
<?php
session_start();
session_unset();
session_destroy();
header('location:login.php');
?>