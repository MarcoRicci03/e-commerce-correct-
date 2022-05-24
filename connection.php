<?php
$servername = "localhost";
$username = "riccimarco";
$password = "";
$dbname = "my_riccimarco";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
