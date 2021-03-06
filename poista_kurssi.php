<?php

// Tiedosto poistaa valitun kurssin
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

    // Haetaan kurssiin liittyvät kyselyt
    $sql = "SELECT kurssikyselyid FROM kurssikysely WHERE kurssiid = ?";
    $tarkaste = $yhteys->prepare($sql);
    $tarkaste->execute(array($_POST["kurssiid"]));
    $tar = $tarkaste->fetchAll();

    // Poistettavaan kurssiin ei liity kurssikyselyitä ja se poistetaan
    if (sizeof($tar) == 0) {

        $pois = "DELETE FROM kurssi WHERE kurssiid = ?";
        $poisto = $yhteys->prepare($pois);
        $poisto->execute(array($_POST["kurssiid"]));

        header("Location: hkursseja.php?opettaja=" . $_GET["opettaja"] . "&viesti=OK!");
    }
    // Kurssiin liittyy kyselyitä, eikä sitä voida poistaa
    else {

        header("Location: hkursseja.php?opettaja=" . $_GET["opettaja"] . "&viesti=v");
    }
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>



