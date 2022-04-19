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
   
}
session_destroy();
header("location:profile.php");
