<?php 
include("../connection.php");
session_start();
$sql = "INSERT INTO orders (price, id_cart, id_address) VALUES (?, ?, ?)";
//SELECT sum(price) FROM articles INNER JOIN contain on articles.id_article = contain.id_article WHERE contain.id_cart = (SELECT id_cart from carts where carts.id_user = 2);
header("location:../index/index.php")
?>