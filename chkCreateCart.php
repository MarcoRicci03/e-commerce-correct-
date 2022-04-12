<?php
session_start();
// if (!isset($_COOKIE["user_$_SESSION[id_user]"]) && !isset($_COOKIE["user_$_SERVER[REMOTE_ADDR]"])) {
if (!isset($_COOKIE["cart"])) {
    // if (isset($_SESSION["id_user"])) {
    $cookie_name = "cart";
    $cookie_value = " ";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    // } else {
    //     $cookie_name = "user_$_SERVER[REMOTE_ADDR]";
    //     $cookie_value = " ";
    //     setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    // }
}
