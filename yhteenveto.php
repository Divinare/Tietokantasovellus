<?php
// Luodaan opettajalle ja vastuuhenkilölle linkit kurssikyselyiden tuloksiin
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Yhteenveto</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Yhteenveto</h1>
    <div class="box">
        <?php
        // Istuntotarkastus
        if ($_SESSION["ihminen"] == $_GET["yhteenveto"]) {

            // Haetaan sivulletulijan rooli
            $sqlrooli = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
            $sqlrooli2 = $yhteys->prepare($sqlrooli);
            $sqlrooli2->execute(array($_GET["yhteenveto"]));
            $rooli = $sqlrooli2->fetch();

            // Vastuuhenkilö näkee kaikki kurssikyselyiden tulokset
            if ($rooli[0] == "vastuuhenkilö") {
                ?>
                <h3>Voimassa olevat kurssikyselyt</h3>
                <?php
                $voimassa = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';

                foreach ($yhteys->query($voimassa) as $tulos) {

                    // Haetaan kurssikyselyyn liittyvä henkiloID
                    $sql = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($tulos['kurssikyselyid']));
                    $hloID = $op->fetch();

                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sql = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($hloID[0]));
                    $hloTiedot = $op->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $hloTiedot[0][0] . " " . $hloTiedot[0][1] . " - " . $hloTiedot[0][2] . " - Vuosi: " . $hloTiedot[0][3] . " Periodi: " . $hloTiedot[0][4] . ")" . "<br>";
                }
                ?>
                <br>
                <h3>Päättyneet kurssikyselyt</h3>
                <?php
                $sql = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE ORDER BY kknimi';

                foreach ($yhteys->query($sql) as $tulos) {

                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sql = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($tulos['kurssikyselyid']));
                    $hloID = $op->fetch();

                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sql = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($hloID[0]));
                    $hloTiedot = $op->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $hloTiedot[0][0] . " " . $hloTiedot[0][1] . " - " . $hloTiedot[0][2] . " - Vuosi: " . $hloTiedot[0][3] . " Periodi: " . $hloTiedot[0][4] . ")" . "<br>";
                }
            }
            // Opettaja näkee vain omien kurssikyselyidensä tulokset
            if ($rooli[0] == "opettaja") {
                ?>
                <h3>Voimassa olevat kurssikyselyt</h3>
                <?php
                $sql = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE and henkiloid = ? ORDER BY kknimi';
                $op = $yhteys->prepare($sql);
                $op->execute(array($_GET["yhteenveto"]));
                $taulu = $op->fetchAll();

                foreach ($taulu as $tulos) {

                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sql = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($tulos['kurssikyselyid']));
                    $hloID = $op->fetch();

                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sql = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($hloID[0]));
                    $hloTiedot = $op->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $hloTiedot[0][0] . " " . $hloTiedot[0][1] . " - " . $hloTiedot[0][2] . " - Vuosi: " . $hloTiedot[0][3] . " Periodi: " . $hloTiedot[0][4] . ")" . "<br>";
                }
                ?>
                <br>
                <h3>Päättyneet kurssikyselyt</h3>
                <?php
                $sql = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE and henkiloid = ? ORDER BY kknimi';
                $op = $yhteys->prepare($sql);
                $op->execute(array($_GET["yhteenveto"]));
                $taulu = $op->fetchAll();


                foreach ($taulu as $tulos) {

                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sql = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($tulos['kurssikyselyid']));
                    $hloID = $op->fetch();

                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sql = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $op = $yhteys->prepare($sql);
                    $op->execute(array($hloID[0]));
                    $hloTiedot = $op->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $hloTiedot[0][0] . " " . $hloTiedot[0][1] . " - " . $hloTiedot[0][2] . " - Vuosi: " . $hloTiedot[0][3] . " Periodi: " . $hloTiedot[0][4] . ")" . "<br>";
                }
            }
            ?>
        </div>
        <ul class="navbar">
            <li><p><a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['yhteenveto']; ?>>Oma sivu</a></p></li>
            <li><p><a href=index.php>Kirjaudu ulos</a></p></li>
        </ul>
            <?php
        }
        // Istuntotarkastus failaa
        else {
            header("Location: access_denied.php");
        }
        ?>
</body>
