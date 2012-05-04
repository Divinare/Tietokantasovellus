<?php

// Henkilön lisäys
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["lisays"]) {

    // Koetetaan hakea sähköposti tietokannasta (kahta samaa sähköpostia ei saa olla)
    $sql = "SELECT email FROM henkilo WHERE email = ?";
    $kysely = $yhteys->prepare($sql);
    $kysely->execute(array($_POST['sposti']));
    $taulu = $kysely->fetch();

    // Tarkastetaan onko kentät täytetty oikein
    if (empty($_POST['etu'])) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=etupuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if (strlen($_POST['etu']) > 30) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=etupitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }

    if (empty($_POST['suku'])) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=sukupuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }

    if (strlen($_POST['suku']) > 30) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=sukupitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }

    if (empty($_POST['sposti'])) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=emailpuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if (strlen($_POST['sposti']) > 30) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=emailpitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if (strlen($taulu[0][0] > 0)) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=emailkäytössä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if (empty($_POST['passu'])) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salapuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if (strlen($_POST['passu']) > 30) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salapitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if (strlen($_POST['passu']) < 8) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salalyhyt" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
    if ($_POST['passu'] != $_POST['passu2']) {
        header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salateitäsmää" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
        die();
    }
// Tarkastukset ok!
// Siirretään tiedot session muuttujilla vahvista_henkilo.php:seen
    $_SESSION["etu"] = $_POST["etu"];
    $_SESSION["suku"] = $_POST["suku"];
    $_SESSION["email"] = $_POST["sposti"];
    $_SESSION["pw"] = $_POST["passu"];
    $_SESSION["rooli"] = $_POST["rooli"];
    header("Location: vahvista_henkilo.php?admin=" . $_GET["lisays"]);

// Istuntotarkistus failaa
} else {
    header("Location: access_denied.php");
    die();
}
?>
