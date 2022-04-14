<?php
session_start();
$vettQuantita = explode("-", $_COOKIE['cart_quantita']);
$max =  sizeof($vettQuantita);
for ($i = 0; $i < $max; $i++) {
    $vettQuantita[$i] = intval($vettQuantita[$i]);
}
\array_splice($vettQuantita, sizeof($vettQuantita) - 1, 1);
if ($_GET['action'] == 'add') {
    $vettQuantita[$_GET['pos']]++;
    $_SESSION["sommaProdotti"]++;
} else if($_GET['action'] == 'decrease'){
    $vettQuantita[$_GET['pos']]--;
    $_SESSION["sommaProdotti"]--;
}
$stringQuantita = "";
for ($i = 0; $i < sizeof($vettQuantita); $i++) {
    $stringQuantita .= $vettQuantita[$i] . "-";
}
setcookie("cart_quantita", $stringQuantita, time() + (86400 * 30), "/"); // 86400 = 1 day
header("location:cart.php");
