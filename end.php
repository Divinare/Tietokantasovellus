<?php

// Kyselyn loppusivu - näytetään kyselyyn vastanneelle vastausten tallentamisen jälkeen
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Äskeiseltä sivulta lähetetyt
$arvosanat = $_POST["arvosana"];
$kommentit = $_POST["kommentti"];
$kysymysidt = $_POST["kysymysidt"];

// Selaimen palkkiotsikko
$sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid = ?';
$kyselytitle = $yhteys->prepare($sql);
$kyselytitle->execute(array($_SESSION["kyselyid"]));
$htmltitle = $kyselytitle->fetch();

// Arvosanat tauluun
for ($i = 0, $size = sizeof($arvosanat); $i < $size; ++$i) {

    $sql3 = 'INSERT INTO vastaus VALUES (?, ?, ?)';
    $insertti = $yhteys->prepare($sql3);
    $insertti->execute(array($kysymysidt[$i], $arvosanat[$i], $_SESSION["kyselyid"]));
}

// Kommentit tauluun
for ($k = 0, $ksize = sizeof($kommentit); $k < $ksize; ++$k) {

    if (!$kommentit[$k] == "") {
        $sql4 = 'INSERT INTO kommentti VALUES (?, ?, ?)';
        $kinsertti = $yhteys->prepare($sql4);
        $kinsertti->execute(array($kommentit[$k], $kysymysidt[$k], $_SESSION["kyselyid"]));
    }
}

// Kiittelyteksti
$sqlkurssi = 'SELECT nimi FROM kurssi INNER JOIN kurssikysely ON kurssikysely.kurssiid = kurssi.kurssiid WHERE kurssikysely.kurssikyselyid =' . $_SESSION["kyselyid"];
$kurssi = $yhteys->prepare($sqlkurssi);
$kurssi->execute();
$kurssinnimi = $kurssi->fetch();

$_SESSION["kknimi"] = $htmltitle['kknimi'];
$_SESSION["knimi"] = $kurssinnimi['nimi'];

header("Location: end_kysely.php");

?>
