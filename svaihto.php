<?php

// Tarkastetaan että salasananvaihdon kentät ovat kunnossa
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["svaihto"]) {

    // Haetaan henkilön vanha salasana tietokannasta
    $sql = 'SELECT salasana FROM henkilo WHERE henkiloid = ?';
    $sala = $yhteys->prepare($sql);
    $sala->execute(array($_GET["svaihto"]));
    $vsala = $sala->fetch();

    // Kryptataan annettu vanha salasana jotta sitä voidaan verrata tietokannan kryptattuun salasanaan
    $tiiviste = md5(md5($_POST["vanha"] . "greippejäomnomnom") . "lisääsitruksia");

    // Salasanantarkastukset
    if ($tiiviste != $vsala["salasana"]) {
        header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=vanhavaara");
        die();
    }
    if (strlen($_POST["uusi"]) > 15) {
        header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=salapitkä");
        die();
    }
    if (strlen($_POST["uusi"]) < 8) {
        header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=salalyhyt");
        die();
    }
    if ($_POST["uusi"] != $_POST["uusi2"]) {
        header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=salateitäsmää");
        die();
    }

// Tarkastukset ok!
    $_SESSION["uusi"] = $_POST["uusi"];
    header("Location: svaihto2.php?svaihto2=" . $_GET["svaihto"]);
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>
