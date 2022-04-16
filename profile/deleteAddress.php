<?php
include("../connection.php");
$q = "DELETE FROM addresses WHERE id_address = $_GET[id]";
$result = $conn->query($q);
header("location:profile.php");