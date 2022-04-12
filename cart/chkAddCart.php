<?php
include("../connection.php");
session_start();
$q = "SELECT amount FROM articles WHERE id_article = $_GET[id_article]";
$result = $conn->query($q);
if ($result) {
    $row = $result->fetch_assoc();
    if ($row["amount"] > 0) {
        // if (isset($_SESSION["id_user"])) {
        //     $cookie_name = "user_$_SESSION[id_user]";
        // } else {
        //     $cookie_name = "user_$_SERVER[REMOTE_ADDR]";
        // }
        // $cookie_value = $_COOKIE[$cookie_name];
        $cookie_value = $_COOKIE["cart"];

        if ($cookie_value == " ") {
            $cookie_value = "$_GET[id_article]-1n";
        } else {
            $cookie_value .= "$_GET[id_article]-1n";
        }
        setcookie("cart", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
}
header("location:../index/index.php");
