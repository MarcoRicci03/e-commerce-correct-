<?php
include("../connection.php");
session_start();
//$sql = "SELECT sum(price) FROM articles INNER JOIN contain on articles.id_article = contain.id_article WHERE contain.id_cart = (SELECT id_cart from carts where carts.id_user = 2)";

$sql = "SELECT sum(price * contain.amount) FROM articles INNER JOIN contain on articles.id_article = contain.id_article WHERE contain.id_cart = (SELECT id_cart from carts where carts.id_user = $_SESSION[id_user])";
$q = "SELECT id_cart from carts where carts.id_user = $_SESSION[id_user]";
$resultq = $conn->query($q);
$rowq = $resultq->fetch_assoc();
$id_cart = $rowq['id_cart'];



$resultsql = $conn->query($sql);
$rowsql = $resultsql->fetch_assoc();

$stmt = $conn->prepare("INSERT INTO orders (price, id_cart, id_address) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $price, $id_cart, $id_address);
$price = $rowsql["sum(price * contain.amount)"];
//$id_cart = $_SESSION['id_cart'];
$id_address = $_POST['cmbAddresses'];
$stmt->execute();


$cookie_name = "cart_ids_" . $_SESSION['id_user'];
$cookie_value = " ";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
$cookie_name = "cart_quantita_" . $_SESSION['id_user'];
$cookie_value = " ";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


$sql = "UPDATE carts SET closed=1 WHERE id_user=$_SESSION[id_user]";

$res = $conn->query($sql);


header("location:../index/index.php");
