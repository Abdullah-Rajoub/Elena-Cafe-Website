<?php
session_start(); 
$_SESSION['edit']="yes";
header("location: profile.php");
?>