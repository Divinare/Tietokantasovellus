<?php
// Tarkastetaan että salasananvaihdon kentät ovat kunnossa
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Salasanan vaihto</title>
    <meta charset="utf-8">
</head>

<body>

    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["svaihto"]) {

        // Haetaan henkilön vanha salasana tietokannasta
        $sql = 'SELECT salasana FROM henkilo WHERE henkiloid = ?';
        $sala = $yhteys->prepare($sql);
        $sala->execute(array($_GET["svaihto"]));
        $vsala = $sala->fetch();

        // Kryptataan annettu vanha salasana jotta sitä voidaan verrata tietokannan kryptattuun salasanaan
        $tiiviste = md5(md5($_POST["vanha"] . "greippejäomnomnom") . "lisääsitruksia");

        // Salasanantarkastukset
        if ($tiiviste != $vsala["salasana"]) {
            header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=vanhavaara");
            die();
        }
        if (strlen($_POST["uusi"]) > 15) {
            header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=salapitkä");
            die();
        }
        if (strlen($_POST["uusi"]) < 8) {
            header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=salalyhyt");
            die();
        }
        if ($_POST["uusi2"] != $_POST["uusi2"]) {
            header("Location: vaihdasala.php?vaihdasala=" . $_GET["svaihto"] . "&viesti=salateitäsmää");
            die();
        }

        // Tarkastukset ok!
        // Uuden salasanan kryptaaminen
        $salasana = $_POST["uusi"];
        $tiiviste = md5(md5($salasana . "greippejäomnomnom") . "lisääsitruksia");

        // Salasanan päivittäminen kantaan
        $sqlsala = 'UPDATE Henkilo SET salasana = ? WHERE henkiloID = ?';
        $sqlsala2 = $yhteys->prepare($sqlsala);
        $sqlsala2->execute(array($tiiviste, $_GET["svaihto"]));

        // Roolin hakeminen takaisin-linkkiä varten
        $sql = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
        $kyselyrooli = $yhteys->prepare($sql);
        $kyselyrooli->execute(array($_GET["svaihto"]));
        $rooli = $kyselyrooli->fetch();
        ?>
        <h1>Salasanan vaihto</h1>
        <div class="box">

            <p>Onnistui!</p>

        </div>
        <ul class="navbar">
            <li><p> <a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET["svaihto"]; ?>>Oma sivu</a></p></li>
        </ul>
    <?php
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>

</body>
