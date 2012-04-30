<?php

// periodi, knimi, vuosi
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

    // Valitaan kohdesivu sen mukaan, mistä tänne on tultu
    if ($_GET["mista"] == "h") {
       $_SESSION["minne"] = "hkursseja.php";
    }
    else if ($_GET["mista"] == "l") {
       $_SESSION["minne"] = "luo_kysely.php";
    }
    else {
        header("Location: access_denied.php"); die();
    }

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
                header("Location: lisaa_kurssi.php?opettaja=" . $_GET["opettaja"]); die();
            }
            // Vuosiluvussa kirjaimia tai muuta turhaa
            else {

                header("Location: kurssi.php?opettaja=" . $_GET["opettaja"] . "&virhe=vk"); die();
            }
        }
        // Vuosiluku liian pitkä/lyhyt
        else {
            header("Location: kurssi.php?opettaja=" . $_GET["opettaja"] . "&virhe=vp");  die();
        }
    }
    // Nimen liian pitkä/lyhyt
    else {
        header("Location: kurssi.php?opettaja=" . $_GET["opettaja"] . "&virhe=n");  die();
    }
    // Istunto-ongelma
} else {
    header("Location: access_denied.php");  die();
}
?>
