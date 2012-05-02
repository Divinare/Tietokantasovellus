<?php
// Lisää tietokantaan henkilön, jonka tiedot saadaan lisays.php:stä.
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Henkilö lisätty</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Henkilön lisäys</h1>
    <div class="box">

        <?php

        // Istuntotarkastus
        if ($_SESSION["ihminen"] == $_GET["lomakelahetys"]) {
            ?>

            <h3>Onnistui!</h3>
        </div>
        <ul class="navbar">
            <li><p><a href=admin.php?admin=<?php print $_GET['lomakelahetys']; ?>>Oma sivu</a></p></li>
        </ul>

        <?php
        $salasana = $_POST["passu"];

        // Kryptataan lisättävän henkilön salasana
        $tiiviste = md5(md5($salasana . "greippejäomnomnom") . "lisääsitruksia");

        $sql = 'INSERT INTO Henkilo values (?, ?, ?, ?, ?)';
        $laita = $yhteys->prepare($sql);
        $laita->execute(array($_POST["etu"], $_POST["suku"], $_POST["sposti"], $tiiviste, $_POST["rooli"]));
    }
    // Istuntotarkastsus failaa
    else {
        header("Location: access_denied.php");
        die();
    }
    ?>
</body>
