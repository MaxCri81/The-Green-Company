<?php 
session_start();
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['role'] = null;

header("Location: ../../index.php");

?>