<?php
//legenda del cookie-> id-quantita
include("../connection.php");
session_start();
$q = "SELECT amount FROM articles WHERE id_article = $_GET[id_article]";
$result = $conn->query($q);
if ($result) {
    $row = $result->fetch_assoc();
    if ($row["amount"] > 0) {
        if ($_COOKIE["cart_ids"] != " " && $_COOKIE["cart_quantita"] != " ") {
            if (str_contains($_COOKIE["cart_ids"], '-')) {
                $vettIDS = explode("-", $_COOKIE["cart_ids"]);
                for ($i = 0; $i < sizeof($vettIDS); $i++) {
                    $vettIDS[$i] = intval($vettIDS[$i]);
                }
                \array_splice($vettIDS, sizeof($vettIDS) - 1, 1);
            }
            if (str_contains($_COOKIE["cart_quantita"], '-')) {
                $vettQuantita = explode("-", $_COOKIE["cart_quantita"]);
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
        setcookie("cart_ids", $stringIDS, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("cart_quantita", $stringQuantita, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
}
header("location:../index/index.php");
