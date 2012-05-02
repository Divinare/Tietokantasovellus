<?php

// Katsotaan voidaanko henkilö poistaa
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["admin"]) {

    //Haetaan adminin kryptattu salasana:
    $sqls = 'SELECT salasana FROM henkilo WHERE henkiloid = ?';
    $sqls2 = $yhteys->prepare($sqls);
    $sqls2->execute(array($_GET["admin"]));
    $taulus = $sqls2->fetch();
    $kryptattupw = md5(md5($_POST["poista"] . "greippejäomnomnom") . "lisääsitruksia");

    // Tarkastetaan, onko salasana oikein
    if ($kryptattupw == $taulus[0]) {

        // Tarkastetaan, ettei henkilö yritä poistaa itseään
        if ($_GET["admin"] == $_GET["henkiloid"]) {
            header("Location: muokkaah.php?admin=" . $_GET["admin"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=itsefail");
            die();
        } else {
            header("Location: poistah_onnistui.php?admin=" . $_GET["admin"] . "&henkiloid=" . $_GET["henkiloid"]);
            die();
        }
    } else {
        header("Location: muokkaah.php?admin=" . $_GET["admin"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=salafail");
        die();
    }
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>


