<?php
include("../connection.php");
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
        $pass = $_POST['txtPass'];
        $name = $_POST['txtName'];
        $surname = $_POST['txtSurname'];
        $stmt->execute();
    }
} else {
    header("location:register.php?msg=Le password non corrispondono.");
}
