<?php

// Kysymyksenlisäysoperaatiot
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["opettaja"]) {


    // Selvitys siitä, minne sivu ohjautuu
    if ($_GET["mista"] == "u") {
        $minne = "uusi.php";
    } else {
        $minne = "muokkaa.php";
    }

    $syote = $_POST["ukysymys"];

    // Uuden kysymyksen pituuden tarkastaminen
    if (strlen($syote) > 0 && strlen($syote) < 301) {

        // Uuden kysymyksen lisääminen tietokantaan
        $ukysymys = $_POST["ukysymys"];
        $sql0 = 'INSERT INTO Kysymys VALUES (?, ?)';
        $lisays = $yhteys->prepare($sql0);
        $lisays->execute(array($ukysymys, $_GET["kyselyid"]));

        header("Location: " . $minne . "?opettaja=" . $_GET["opettaja"] . "&kyselyid=" . $_GET['kyselyid'] . "&viesti=OK!");
        die();
    }
    // Kysymyksen pituus on vääränlainen
    else {
        $p = strlen($syote);
        header("Location: " . $minne . "?opettaja=" . $_GET["opettaja"] . "&kyselyid=" . $_GET['kyselyid'] . "&viesti=yhyy&p=" . $p);
        die();
    }
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>
