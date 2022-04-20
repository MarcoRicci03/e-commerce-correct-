<?php
session_start();
include('../connection.php');

$stringCookieQuantita = "cart_quantita";
$stringCookieID = "cart_ids";
$quantitaSessionName = "sommaProdotti";

if (isset($_SESSION['id_user'])) {
    $stringCookieID = "cart_ids_" . $_SESSION['id_user'];
    $quantitaSessionName = "sommaProdotti_" . $_SESSION['id_user'];
    $stringCookieQuantita = "cart_quantita_" . $_SESSION['id_user'];
    $vettID = explode("-", $_COOKIE[$stringCookieID]);
    \array_splice($vettID, sizeof($vettID) - 1, 1);
    $IDFORQUERY = $vettID[$_GET['pos']];

    $q = "select id_contain, amount from contain where id_article = $IDFORQUERY and id_cart = (
        select id_cart from carts where closed = 0 and id_user = $_SESSION[id_user])";
    $result = $conn->query($q);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $valoreTemp = 0;
        if ($_GET['action'] == 'add') {
            $valoreTemp = intval($row['amount']) + 1;
        } else if ($_GET['action'] == 'decrease') {
            $valoreTemp = intval($row['amount']) - 1;
        }
        $q = "UPDATE contain SET amount = $valoreTemp WHERE contain.id_contain = $row[id_contain]";
        $result = $conn->query($q);
    }
}
$vettQuantita = explode("-", $_COOKIE[$stringCookieQuantita]);
$max =  sizeof($vettQuantita);
for ($i = 0; $i < $max; $i++) {
    $vettQuantita[$i] = intval($vettQuantita[$i]);
}
\array_splice($vettQuantita, sizeof($vettQuantita) - 1, 1);
if ($_GET['action'] == 'add') {
    $vettQuantita[$_GET['pos']]++;
    $_SESSION["sommaProdotti"]++;
} else if ($_GET['action'] == 'decrease') {
    $vettQuantita[$_GET['pos']]--;
    $_SESSION["sommaProdotti"]--;
}
$stringQuantita = "";
for ($i = 0; $i < sizeof($vettQuantita); $i++) {
    $stringQuantita .= $vettQuantita[$i] . "-";
}
setcookie($stringCookieQuantita, $stringQuantita, time() + (86400 * 30), "/"); // 86400 = 1 day
header("location:cart.php");
