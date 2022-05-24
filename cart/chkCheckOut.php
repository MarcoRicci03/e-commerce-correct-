<?php
include("../connection.php");
session_start();

$sql = "SELECT sum(price * contain.amount) as prezzoTot FROM articles INNER JOIN contain on articles.id_article = contain.id_article WHERE contain.id_cart = (SELECT id_cart from carts where carts.id_user = $_SESSION[id_user] and closed = 0)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row["prezzoTot"] == null) {
        $prezzoSQL =  0;
} else {
        $prezzoSQL = $row["prezzoTot"];
}
//prendo id carrello
$sqlCarrello = "SELECT id_cart from carts where carts.id_user = $_SESSION[id_user] AND closed = 0";
$resultCarrello = $conn->query($sqlCarrello);
$rowCarrello = $result->fetch_assoc();
$idCarrello = $row["id_cart"];

$stmt = $conn->prepare("INSERT INTO orders (price, id_cart, id_address) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $price, $id_cart, $id_address);
// set parameters and execute
$price = $prezzoSQL;
$id_cart = $_SESSION['id_cart'];
$id_address = $_POST['cmbAddress'];

$stmt->execute();

$sql = "UPDATE carts SET closed = 1 WHERE id_user = $_SESSION[id_user]";
$result = $conn->query($sql);

if (isset($_COOKIE['cart_ids_' . $_SESSION['id_user']])) {
        setcookie('cart_ids_' . $_SESSION['id_user'], " ", time() + (86400 * 30), "/");
        setcookie('cart_quantita_' . $_SESSION['id_user'], " ", time() + (86400 * 30), "/");
} 


header("location:../index/index.php");
