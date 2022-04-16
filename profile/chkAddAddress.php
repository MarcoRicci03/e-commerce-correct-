<?php
include("../connection.php");
session_start();
$stmt = $conn->prepare("INSERT INTO addresses (id_user, address, city, postal_code) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $id_user, $address, $city, $postal_code);
// set parameters and execute
$id_user = $_SESSION['id_user'];
$address = $_POST['txtAddress'];
$city = $_POST['txtCity'];
$postal_code = $_POST['txtPostal_code'];
$stmt->execute();
header("location:profile.php");
