<?php 
include("../connection.php");
session_start();
$query1=$conn->prepare("UPDATE users SET mail=?, username=?, name=?, surname=? WHERE id_user = $_SESSION[id_user]");
$query1->bind_param('ssss',$mail, $username, $name, $surname); //error
// set parameters and execute
$mail = $_POST['txtMail'];
$username = $_POST['txtUsername'];
$name = $_POST['txtName'];
$surname = $_POST['txtSurname'];
$query1->execute();
header("location:profile.php")
?>