<?php
session_start();
include("../connection.php");



$stringCookieID = "cart_ids";
$stringCookieQuantita = "cart_quantita";
if (isset($_SESSION['id_user'])) {
    $stringCookieID = "cart_ids_" . $_SESSION['id_user'];
    $stringCookieQuantita = "cart_quantita_" . $_SESSION['id_user'];
}
$vettQuantita = explode("-", $_COOKIE[$stringCookieQuantita]);
$vettIDS = explode("-", $_COOKIE[$stringCookieID]);
$max =  sizeof($vettQuantita);
for ($i = 0; $i < $max; $i++) {
    $vettQuantita[$i] = intval($vettQuantita[$i]);
    $vettIDS[$i] = intval($vettIDS[$i]);
}
\array_splice($vettQuantita, sizeof($vettQuantita) - 1, 1);
\array_splice($vettIDS, sizeof($vettIDS) - 1, 1);
$IDFORQUERY = $vettIDS[$_GET['pos']];
if (isset($_SESSION['id_user'])) {
    $q = "delete from contain where id_article = $IDFORQUERY and id_cart = (
        select id_cart from carts where closed = 0 and id_user = $_SESSION[id_user])";
    $result = $conn->query($q);
}

\array_splice($vettQuantita, $_GET['pos'], 1);
\array_splice($vettIDS, $_GET['pos'], 1);


$stringQuantita = "";
$stringIDS = "";
for ($i = 0; $i < sizeof($vettQuantita); $i++) {
    $stringIDS .= $vettIDS[$i] . "-";
    $stringQuantita .= $vettQuantita[$i] . "-";
}
setcookie($stringCookieQuantita, $stringQuantita, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie($stringCookieID, $stringIDS, time() + (86400 * 30), "/"); // 86400 = 1 day

$_SESSION["sommaProdotti"]--;
header("location:cart.php");
