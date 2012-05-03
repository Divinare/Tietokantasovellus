<?php

// Tarkastetaan voidaanko henkilön tietoja muuttaa. Jos voidaan niin muutetaan, laitetaan viestiksi "ok" ja palataan takaisin.
// Jos ei, niin laitetaan viestiksi virheilmo ja palataan takaisin.
// Urlissa pidetään mukana myös jo annettuja tietoja ettei niitä tarvitse uudelleen täyttää.
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["muutah"]) {

    if ($_GET["viesti"] == etunimi) {
        $pituus = strlen($_POST["etu"]);
        if ($pituus > 0 && $pituus < 31) {
            $sql = 'UPDATE henkilo SET etunimi = ? WHERE henkiloid = ?';
            $sqlv = $yhteys->prepare($sql);
            $sqlv->execute(array($_POST["etu"], $_GET["henkiloid"]));
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=ok");
            die();
        } else {
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=etufail");
            die();
        }
    }
    if ($_GET["viesti"] == sukunimi) {
        $pituus = strlen($_POST["suku"]);
        if ($pituus > 0 && $pituus < 31) {
            $sql = 'UPDATE henkilo SET sukunimi = ? WHERE henkiloid = ?';
            $sqlv = $yhteys->prepare($sql);
            $sqlv->execute(array($_POST["suku"], $_GET["henkiloid"]));
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=ok");
            die();
        } else {
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=sukufail");
            die();
        }
    }
    if ($_GET["viesti"] == sukunimi) {
        $pituus = strlen($_POST["suku"]);
        if ($pituus > 0 && $pituus < 31) {
            $sql = 'UPDATE henkilo SET sukunimi = ? WHERE henkiloid = ?';
            $sqlv = $yhteys->prepare($sql);
            $sqlv->execute(array($_POST["suku"], $_GET["henkiloid"]));
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=ok");
            die();
        } else {
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=sukufail");
            die();
        }
    }
    if ($_GET["viesti"] == sähköposti) {
        // Koitetaan hakea sähköposti tietokannasta (kahta samaa sähköpostia ei saa olla)
        $sqls = 'SELECT email FROM henkilo WHERE email = ?';
        $kyselys = $yhteys->prepare($sqls);
        $kyselys->execute(array($_POST["sähkö"]));
        $taulu = $kyselys->fetch();
        if (strlen($taulu[0] > 0)) {
	header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=emailkaytossa");
	die();
	}
        $pituus = strlen($_POST["sähkö"]);
        if ($pituus > 0 && $pituus < 31) {
            $sql = 'UPDATE henkilo SET email = ? WHERE henkiloid = ?';
            $sqlv = $yhteys->prepare($sql);
            $sqlv->execute(array($_POST["sähkö"], $_GET["henkiloid"]));
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=ok");
            die();
	}
        else {
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=emailfail");
            die();
        }
    }

    //Omaa roolia ei voida muokata
    if ($_GET["henkiloid"] != $_GET["muutah"]) {
        if (!empty($_POST["rooli"])) {
            $rooli = $_POST["rooli"];
            $sqlr = 'UPDATE henkilo SET rooli = ? WHERE henkiloid = ?';
            $sqlr2 = $yhteys->prepare($sqlr);
            $sqlr2->execute(array($rooli, $_GET["henkiloid"]));
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=ok");
            die();
        } else {
            header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=emptyradiofail");
        }
    } else {
        header("Location: muokkaah.php?admin=" . $_GET["muutah"] . "&henkiloid=" . $_GET["henkiloid"] . "&viesti=omafail");
        die();
    }
// Istuntotarkastus failaa
} else {
    header("Location: access_denied.php");
    die();
}
?>
