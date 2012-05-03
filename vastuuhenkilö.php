<?php
// Vastuuhenkilön etusivu
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Vastuuhenkilö</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["vastuuhenkilö"]) {

        // Haetaan vastuuhenkilön tiedot
        $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
        $kyselyadmin = $yhteys->prepare($sql);
        $kyselyadmin->execute(array($_GET["vastuuhenkilö"]));
        $nimi = $kyselyadmin->fetch();
        ?>
        <h1>Laitoksen vastuuhenkilö - <?php print $nimi[0] . " " . $nimi[1]; ?> </h1>

        <div class="box">
           <br><br><br><br><br><br><br><br><br><br>
        </div>

        <ul class="navbar">

            <li><p><a href=yhteenveto.php?yhteenveto=<?php print $_GET["vastuuhenkilö"]; ?>>Kaikkien kurssikyselyiden tulokset</a></p></li>

            <li><p><a href=vaihdasala.php?vaihdasala=<?php print $_GET["vastuuhenkilö"]; ?>>Salasanan vaihto</a></p></li>

            <li><p><a href=index.php>Kirjaudu ulos</a></p></li>

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
