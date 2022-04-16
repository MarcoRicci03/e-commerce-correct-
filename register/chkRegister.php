<?php
include("../connection.php");
session_start();
if ($_POST['txtPass'] == $_POST['txtPassConfirm']) {
    $q = "SELECT * FROM users WHERE username = '$_POST[txtUsername]' OR mail = '$_POST[txtMail]'";
    $result = $conn->query($q);
    if ($result->fetch_assoc() > 0) {
        header("location:register.php?msg=Username o mail giá usata.");
    } else {
        $stmt = $conn->prepare("INSERT INTO users (mail, username, pass, name, surname) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $mail, $username, $pass, $name, $surname);
        // set parameters and execute
        $mail = $_POST['txtMail'];
        $username = $_POST['txtUsername'];
        $pass = md5($_POST['txtPass']);
        $name = $_POST['txtName'];
        $surname = $_POST['txtSurname'];
        $stmt->execute();
        $_SESSION["id_user"] = $row["id_user"];
        header("location:../index/index.php");
    }
} else {
    header("location:register.php?msg=Le password non corrispondono.");
}
