<?php
session_start();
include("../connection.php");
$stringCookieID = "cart_ids";
$stringCookieQuantita = "cart_quantita";
if (isset($_SESSION['id_user'])) {
    $stringCookieID = "cart_ids_" . $_SESSION['id_user'];
    $stringCookieQuantita = "cart_quantita_" . $_SESSION['id_user'];
}
if (isset($_COOKIE[$stringCookieQuantita])) {
    //salvo il carrello sul database
    $q = "SELECT id_cart FROM carts WHERE id_user = $_SESSION[id_user]";
    $result = $conn->query($q);
    if (sizeof($row = $result->fetch_assoc()) > 0) {
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
    }
}
session_destroy();
header("location:profile.php");
