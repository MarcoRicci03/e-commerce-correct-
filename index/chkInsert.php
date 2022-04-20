<?php
include("../connection.php");
session_start();
if ($_SESSION['admin'] == 1) {
    if ($_POST['txtImage'] != null && $_POST['txtImage'] != "") {
        $stmt = $conn->prepare("INSERT INTO articles (price, amount, id_category, name, description, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("diisss", $price, $amount, $id, $name, $desc, $image);
    } else {
        $stmt = $conn->prepare("INSERT INTO articles (price, amount, id_category, name, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("diiss", $price, $amount, $id, $name, $desc);
    }
    // set parameters and execute
    $price = $_POST['txtPrice'];
    $amount = $_POST['txtQuantita'];
    $id = $_POST['cmbCategoria'];
    $name = $_POST['txtName'];
    $desc = $_POST['txtDesc'];
    $image = $_POST['txtImage'];


    $stmt->execute();
}
header("location:index.php");
