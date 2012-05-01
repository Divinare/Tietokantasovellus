<?php
require_once 'DB.php';
session_start();

$yhteys = db::getDB();

// Äskeiseltä sivulta lähetetyt
$arvosanat = $_POST["arvosana"];
$kommentit = $_POST["kommentti"];
$kysymysidt = $_POST["kysymysidt"];

// Palkkiotsikko
$sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid = ?';
$kyselytitle = $yhteys->prepare($sql);
$kyselytitle->execute(array($_SESSION["kyselyid"]));
$htmltitle = $kyselytitle->fetch();

// Arvosanat tauluun
for ($i = 0, $size = sizeof($arvosanat); $i < $size; ++$i) {

    $maara++;
    $sql3 = 'INSERT INTO vastaus VALUES (?, ?)';
    $insertti = $yhteys->prepare($sql3);
    $insertti->execute(array($kysymysidt[$i], $arvosanat[$i]));
}

// Kommentit tauluun
for ($k = 0, $ksize = sizeof($kommentit); $k < $ksize; ++$k) {

    if (!$kommentit[$k] == "") {
        $kmaara++;
        $sql4 = 'INSERT INTO kommentti VALUES (?, ?)';
        $kinsertti = $yhteys->prepare($sql4);
        $kinsertti->execute(array($kommentit[$k], $kysymysidt[$k]));
    }
}

// Kiittelyteksti
$sqlkurssi = 'SELECT nimi FROM kurssi INNER JOIN kurssikysely ON kurssikysely.kurssiid = kurssi.kurssiid WHERE kurssikysely.kurssikyselyid =' . $_SESSION["kyselyid"];
$kurssi = $yhteys->prepare($sqlkurssi);
$kurssi->execute();
$kurssinnimi = $kurssi->fetch();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <meta charset="utf-8">
    <title><?php print $htmltitle['kknimi'] ?></title>
</head>

<body>

    <h1>Kiitos vastauksistasi</h1>
<ul class="box">
    <h2>Vastauksesi kurssin <?php print $kurssinnimi['nimi']; ?> kurssikyselyyn on tallennettu!</h2>
    <img src="KIITOS.png" width="307" height="284" alt=":)" align="center">
</ul>
<ul class="navbar">
    <li><a href="luoyv.php">Kyselyn yhteenveto</a>
    <li><a href="index.php">Etusivulle</a>
</ul>


</body>
