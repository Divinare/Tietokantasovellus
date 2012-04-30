<?php

// Tämä tiedosto luo kurssikyselyn

require_once 'DB.php';
session_start();


if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

    $yhteys = db::getDB();

    if (isset($_SESSION["idtulos"])) {
       $idtulos = $_SESSION["idtulos"];
       unset($_SESSION["idtulos"]);
    }
    else {
       $idtulos = $_POST["kurssiid"];
    }

    // Uuden kurssikyselyn luonti
    $sql3 = "INSERT INTO Kurssikysely VALUES (?, '(oletus)', ?, False, False)";
    $lisays2 = $yhteys->prepare($sql3);
    $lisays2->execute(array($idtulos, $_GET["opettaja"]));

    // Kurssikyselyn ID:n hakeminen
    $sql4 = "SELECT LASTVAL()";
    $kkid = $yhteys->prepare($sql4);
    $kkid->execute();
    $kkidd = $kkid->fetch();

    header("Location: uusi.php?opettaja=" . $_GET["opettaja"] . "&kyselyid=" . $kkidd[0]);
    die();
} else {
    header("Location: access_denied.php");
    die();
}
?>
