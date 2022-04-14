<?php
session_start();
$vettQuantita = explode("-", $_COOKIE['cart_quantita']);
$vettIDS = explode("-", $_COOKIE['cart_ids']);
$max =  sizeof($vettQuantita);
for ($i = 0; $i < $max; $i++) {
    $vettQuantita[$i] = intval($vettQuantita[$i]);
    $vettIDS[$i] = intval($vettIDS[$i]);
}
\array_splice($vettQuantita, sizeof($vettQuantita) - 1, 1);
\array_splice($vettIDS, sizeof($vettIDS) - 1, 1);

\array_splice($vettQuantita, $_GET['pos'], 1);
\array_splice($vettIDS, $_GET['pos'], 1);


$stringQuantita = "";
$stringIDS = "";
for ($i = 0; $i < sizeof($vettQuantita); $i++) {
    $stringIDS .= $vettIDS[$i] . "-";
    $stringQuantita .= $vettQuantita[$i] . "-";
}
setcookie("cart_quantita", $stringQuantita, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("cart_ids", $stringIDS, time() + (86400 * 30), "/"); // 86400 = 1 day

$_SESSION["sommaProdotti"]--;
header("location:cart.php");
