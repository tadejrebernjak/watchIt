<?php 
    session_start();
	unset($_SESSION['adminID']);
	header("Location:login.php");
?>