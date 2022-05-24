<?php
include("../connection.php");
include("../chkSession.php");

$stmt = $conn->prepare("INSERT INTO comments (text, stars, id_user, id_article) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siii", $text, $stars, $id_user, $id_article);
// set parameters and execute
$text = $_GET['text'];
$stars = $_GET['stars'];
$id_user = $_SESSION["id_user"];
$id_article = $_GET['id_article'];
$stmt->execute();
