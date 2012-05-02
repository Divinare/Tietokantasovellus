<?php

// Kyselyn otsikonvaihtooperaatiot
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

    $pituus = strlen($_POST["kknimi"]);

    // Tarkastetaan, minne sivu ohjautuu
    if ($_GET["mista"] == "u") {
        $minne = "uusi.php";
    } else {
        $minne = "muokkaa.php";
    }

    // Tarkastetaan, onko uuden otsikon pituus sopiva
    if ($pituus > 0 && $pituus < 51) {

        // Otsikon uudelleennimeäminen
        $sqlnimi = 'UPDATE Kurssikysely SET kknimi = ? WHERE kurssikyselyID = ?';
        $unimi = $yhteys->prepare($sqlnimi);
        $unimi->execute(array($_POST["kknimi"], $_GET["kyselyid"]));

        header("Location: " . $minne . "?opettaja=" . $_GET["opettaja"] . "&kyselyid=" . $_GET['kyselyid'] . "&viestiots=OK!");
        die();
    }
    // Otsikon pituus ei ole kelvollinen...
    else {

        header("Location: " . $minne . "?opettaja=" . $_GET["opettaja"] . "&kyselyid=" . $_GET['kyselyid'] . "&viestiots=yhyy&p=" . $pituus);
        die();
    }
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>


