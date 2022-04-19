<?php
session_start();
// if (!isset($_COOKIE["user_$_SESSION[id_user]"]) && !isset($_COOKIE["user_$_SERVER[REMOTE_ADDR]"])) {
if (isset($_SESSION['id_user'])) {
    if (!isset($_COOKIE["cart_ids_" . $_SESSION['id_user']]) && !isset($_COOKIE["cart_quantita_" . $_SESSION['id_user']])) {
        $cookie_name = "cart_ids_" . $_SESSION['id_user'];
        $cookie_value = " ";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $cookie_name = "cart_quantita_" . $_SESSION['id_user'];
        $cookie_value = " ";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
} else if (!isset($_COOKIE["cart_ids"]) && !isset($_COOKIE["cart_quantita"])) {
    $cookie_name = "cart_ids";
    $cookie_value = " ";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    $cookie_name = "cart_quantita";
    $cookie_value = " ";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}
