<?php
//legenda del cookie-> id-quantita
include("../connection.php");
session_start();
//prendo il carrello non pagato
if(isset($_SESSION['id_user'])){
    $q = "select id_contain, amount from contain where id_article = $_GET[id_article] and id_cart = (
        select id_cart from carts where closed = 0 and id_user = $_SESSION[id_user])";
    $result = $conn->query($q);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $q = "UPDATE contain SET amount = " . intval($row['amount']) + 1 . " WHERE contain.id_contain = $row[id_contain]";
        $result = $conn->query($q);
    } else {
        $q = "select id_cart from carts where closed = 0 and id_user = $_SESSION[id_user]";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
    
        $stmt = $conn->prepare("INSERT INTO contain (amount, id_cart, id_article) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $amount, $id_cart, $id_article);
        // set parameters and execute
        $amount = 1;
        $id_cart = $row['id_cart'];
        $id_article = $_GET['id_article'];
        $stmt->execute();
    }
}
$q = "SELECT amount FROM articles WHERE id_article = $_GET[id_article]";
$result = $conn->query($q);
if ($result) {
    $row = $result->fetch_assoc();
    if ($row["amount"] > 0) {
        $stringCookieID = "cart_ids";
        $stringCookieQuantita = "cart_quantita";
        if (isset($_SESSION['id_user'])) {
            $stringCookieID = "cart_ids_" . $_SESSION['id_user'];
            $stringCookieQuantita = "cart_quantita_" . $_SESSION['id_user'];
        }
        if ($_COOKIE[$stringCookieID] != " " && $_COOKIE[$stringCookieQuantita] != " ") {
            if (str_contains($_COOKIE[$stringCookieID], '-')) {
                $vettIDS = explode("-", $_COOKIE[$stringCookieID]);
                for ($i = 0; $i < sizeof($vettIDS); $i++) {
                    $vettIDS[$i] = intval($vettIDS[$i]);
                }
                \array_splice($vettIDS, sizeof($vettIDS) - 1, 1);
            }
            if (str_contains($_COOKIE[$stringCookieQuantita], '-')) {
                $vettQuantita = explode("-", $_COOKIE[$stringCookieQuantita]);
                for ($i = 0; $i < sizeof($vettQuantita); $i++) {
                    $vettQuantita[$i] = intval($vettQuantita[$i]);
                }
                \array_splice($vettQuantita, sizeof($vettQuantita) - 1, 1);
            }
            $aggiunto = false;
            for ($i = 0; $i < sizeof($vettIDS); $i++) {
                if ($vettIDS[$i] ==  $_GET['id_article']) {
                    $vettQuantita[$i]++;
                    $aggiunto = true;
                } else {
                }
            }
            if (!$aggiunto) {
                array_push($vettQuantita, 1);
                array_push($vettIDS, intval($_GET['id_article']));
            }
            $stringIDS = "";
            $stringQuantita = "";
            for ($i = 0; $i < sizeof($vettQuantita); $i++) {
                $stringIDS .= $vettIDS[$i] . "-";
                $stringQuantita .= $vettQuantita[$i] . "-";
            }
        } else {
            $stringIDS = "$_GET[id_article]-";
            $stringQuantita = "1-";
        }
        setcookie($stringCookieID, $stringIDS, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie($stringCookieQuantita, $stringQuantita, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
}
header("location:../index/index.php");
