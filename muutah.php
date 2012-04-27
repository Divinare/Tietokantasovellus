<?php

    require_once 'DB.php';
    session_start();
    $yhteys = db::getDB();

    if ($_SESSION["ihminen"] == $_GET["muutah"]) {

        if ($_GET["viesti"] == etunimi) {
        $pituus = strlen($_POST["etu"]);
            if ($pituus > 0 && $pituus < 31) {
                $sql = 'UPDATE henkilo SET etunimi = ? WHERE henkiloid = ?';
                $sqlv = $yhteys->prepare($sql);
                $sqlv->execute(array($_POST["etu"], $_GET["henkiloid"]));
                header("Location: muokkaah.php?admin=".$_GET["muutah"]."&henkiloid=".$_GET["henkiloid"]."&viesti=ok"); die();
                }
            else {
                header("Location: muokkaah.php?admin=".$_GET["muutah"]."&henkiloid=".$_GET["henkiloid"]."&viesti=etufail"); die();
            }
        }
    }
    else {
      header("Location: access_denied.php"); die();
    }
?>
