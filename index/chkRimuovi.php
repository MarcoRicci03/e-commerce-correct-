<?php
include("../connection.php");
session_start();
if($_SESSION['admin'] == 1){
    $sql = "DELETE FROM articles WHERE id_article = $_GET[id_article]";
    $result = $conn->query($sql);
}
header("location:index.php");
