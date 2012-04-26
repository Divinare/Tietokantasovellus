<?php

// periodi, knimi, vuosi
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

    $pituus = strlen($_POST["knimi"]);

    // Jos nimen pituus sopiva...
    if ($pituus > 0 && $pituus < 51) {

        $pituus = strlen($_POST["vuosi"]);

        // Jos vuosiluvun pituus sopiva...
        if ($pituus > 0 && $pituus < 5) {

            // Jos vuosiluvussa on vain numeroita...
            if (ctype_digit($_POST["vuosi"])) {

                $_SESSION["vuosi"] = $_POST["vuosi"];
                $_SESSION["periodi"] = $_POST["periodi"];
                $_SESSION["knimi"] = $_POST["knimi"];

                // Kaikki testit läpi, siirrytään eteenpäin seuraavalle sivulle
                header("Location: luo_kysely.php?opettaja=" . $_GET["opettaja"]);
            }
            // Vuosiluvussa kirjaimia tai muuta turhaa
            else {

                header("Location: kurssi.php?opettaja=" . $_GET["opettaja"] . "&virhe=vk");
            }
        }
        // Vuosiluku liian pitkä/lyhyt
        else {
            header("Location: kurssi.php?opettaja=" . $_GET["opettaja"] . "&virhe=vp");
        }
    }
    // Nimen liian pitkä/lyhyt
    else {
        header("Location: kurssi.php?opettaja=" . $_GET["opettaja"] . "&virhe=n");
    }
    // Istunto-ongelma
} else {
    header("Location: access_denied.php");
    die();
}
?>
