<?php 
include("../connection.php");
session_start();
//$sql = "SELECT sum(price) FROM articles INNER JOIN contain on articles.id_article = contain.id_article WHERE contain.id_cart = (SELECT id_cart from carts where carts.id_user = 2)";
$sql = "SELECT sum(price * contain.amount) FROM articles INNER JOIN contain on articles.id_article = contain.id_article WHERE contain.id_cart = (SELECT id_cart from carts where carts.id_user = $_SESSION[id_user])";
$q = "SELECT id_cart from carts where carts.id_user = $_SESSION[id_user]";
$result1 = $conn->query($sql);
$row1 = $result->fetch_assoc();
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo var_dump($_SESSION);
$stmt = $conn->prepare("INSERT INTO orders (price, id_cart, id_address) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $price, $id_cart, $id_address);
        // set parameters and execute
        $price = $row["sum(price * contain.amount)"];
        $id_cart = $_SESSION['id_cart'];
        $id_address = $row1[''];
        /* $stmt->execute();
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
 */
//header("location:../index/index.php");
