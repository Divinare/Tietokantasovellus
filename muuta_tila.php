<?php

// Kyselyn näkyvyydenmuutosoperaatiot
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

    // Boolean stringiksi, koska booleanit ovat hölmöjä
    function boolToStr($var) {
        if ($var)
            return "TRUE";
        else
            return "FALSE";
    }

    // Kyselyn tilan muokkaaminen
    if ($_POST["tila"]) {
        $b = TRUE;
    } else {
        $b = FALSE;
    }

    // Tilan päivitys
    $sqltila = 'UPDATE Kurssikysely SET esilla = ?, ollutEsilla = True WHERE kurssikyselyID = ?';
    $tilaa = $yhteys->prepare($sqltila);
    $tilaa->execute(array(boolToStr($b), $_GET["kyselyid"]));

    header("Location: muokkaa.php?opettaja=" . $_GET["opettaja"] . "&kyselyid=" . $_GET['kyselyid']);
    die();
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>
