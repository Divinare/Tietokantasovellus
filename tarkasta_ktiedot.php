<?php

    require_once 'DB.php';
    session_start();
    $yhteys = db::getDB();

    if ($_SESSION["ihminen"] == $_GET["opettaja"]) {


{
?>
