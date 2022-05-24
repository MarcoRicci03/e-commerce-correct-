<?php
include("../connection.php");
include("../chkSession.php");

$stmt = $conn->prepare("UPDATE articles SET amount = ? WHERE id_article = ?");
$stmt->bind_param("ii", $newQ, $idA);
$newQ = $_GET['newQ'];
$idA = $_GET['idA'];
$stmt->execute();
