
<?php

// Henkilönpoistosivu
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["admin"]) {

    // Haetaan henkilön nimi
    $sql = "SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?";
    $op = $yhteys->prepare($sql);
    $op->execute(array($_GET["henkiloid"]));
    $tulos = $op->fetch();
    $_SESSION["pnimi"] = $tulos["etunimi"] . " " . $tulos["sukunimi"];

    // Haetaan kurssit, jotka liittyvät henkilöön
    $sql = "SELECT kurssiID from Kurssi WHERE henkiloID = ?";
    $op = $yhteys->prepare($sql);
    $op->execute(array($_GET["henkiloid"]));
    $kurssiIDt = $op->fetchAll();

    for ($i = 0, $size = sizeof($kurssiIDt); $i < $size; ++$i) {

        // Haetaan kurssikyselyt, jotka liittyvät kursseihin
        $sql = "SELECT kurssikyselyID from Kurssikysely WHERE kurssiID = ?";
        $op = $yhteys->prepare($sql);
        $op->execute(array($kurssiIDt[$i]["kurssiid"]));
        $kkIDt = $op->fetchAll();

        for ($j = 0, $s = sizeof($kkIDt); $j < $s; ++$j) {


            // Poistetaan kommentit, vastausarvot, kysymykset ja kyselyt
            $del = "DELETE FROM Kommentti WHERE kurssikyselyID = ?";
            $op = $yhteys->prepare($del);
            $op->execute(array($kkIDt[$j]["kurssikyselyid"]));

            $del = "DELETE FROM Vastaus WHERE kurssikyselyID = ?";
            $op = $yhteys->prepare($del);
            $op->execute(array($kkIDt[$j]["kurssikyselyid"]));

            $del = "DELETE FROM Kysymys WHERE kurssikyselyID = ?";
            $op = $yhteys->prepare($del);
            $op->execute(array($kkIDt[$j]["kurssikyselyid"]));

            $del = "DELETE FROM Kurssikysely WHERE kurssikyselyID = ?";
            $op = $yhteys->prepare($del);
            $op->execute(array($kkIDt[$j]["kurssikyselyid"]));
        }
    }

    // Poistetaan kurssit
    $del = "DELETE FROM Kurssi WHERE henkiloID = ?";
    $op = $yhteys->prepare($del);
    $op->execute(array($_GET["henkiloid"]));

    // Poistetaan henkilö
    $del = "DELETE FROM henkilo WHERE henkiloid = ?";
    $op = $yhteys->prepare($del);
    $op->execute(array($_GET["henkiloid"]));

    header("Location: poisto_onnistui.php?admin=" . $_SESSION["ihminen"]);
}

// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>

