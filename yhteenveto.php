<?php
// Luodaan opettajalle ja vastuuhenkilölle linkit käynnissä oleviin ja päättyneisiin kurssikyselyiden tuloksiin
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
    <ul class="box">
        <?php
        // Istuntotarkastus
        if ($_SESSION["ihminen"] == $_GET["yhteenveto"]) {

            $sqlrooli = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
            $sqlrooli2 = $yhteys->prepare($sqlrooli);
            $sqlrooli2->execute(array($_GET["yhteenveto"]));
            $rooli = $sqlrooli2->fetch();

            // Vastuuhenkilö näkee kaikki kurssikyselyiden tulokset
            if ($rooli[0] == vastuuhenkilö) {
                print "Käynnissä olevat kurssikyselyt:<br>";
                $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';
                foreach ($yhteys->query($kysely) as $tulos) {
                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sqltk = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetch();
                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sqltiedot = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $sqltiedot2 = $yhteys->prepare($sqltiedot);
                    $sqltiedot2->execute(array($sqltk3[0]));
                    $sqltiedot3 = $sqltiedot2->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $sqltiedot3[0][0] . " " . $sqltiedot3[0][1] . " - " . $sqltiedot3[0][2] . " - Vuosi: " . $sqltiedot3[0][3] . " Periodi: " . $sqltiedot3[0][4] . ")" . "<br>";
                }
                print "<br><br>";
                print "Päättyneet kurssikyselyt:<br>";
                $kysely2 = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE ORDER BY kknimi';
                foreach ($yhteys->query($kysely2) as $tulos) {
                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sqltk = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetch();
                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sqltiedot = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $sqltiedot2 = $yhteys->prepare($sqltiedot);
                    $sqltiedot2->execute(array($sqltk3[0]));
                    $sqltiedot3 = $sqltiedot2->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $sqltiedot3[0][0] . " " . $sqltiedot3[0][1] . " - " . $sqltiedot3[0][2] . " - Vuosi: " . $sqltiedot3[0][3] . " Periodi: " . $sqltiedot3[0][4] . ")" . "<br>";
                }
            }
            // Opettaja näkee vain omien kurssikyselyidensä tulokset
            if ($rooli[0] == opettaja) {
                print "Käynnissä olevat omat kurssikyselyt:<br>";
                $kyselysql = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE and henkiloid = ? ORDER BY kknimi';
                $kyselysql2 = $yhteys->prepare($kyselysql);
                $kyselysql2->execute(array($_GET["yhteenveto"]));
                $taulu = $kyselysql2->fetchAll();
                foreach ($taulu as $tulos) {
                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sqltk = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetch();
                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sqltiedot = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $sqltiedot2 = $yhteys->prepare($sqltiedot);
                    $sqltiedot2->execute(array($sqltk3[0]));
                    $sqltiedot3 = $sqltiedot2->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $sqltiedot3[0][0] . " " . $sqltiedot3[0][1] . " - " . $sqltiedot3[0][2] . " - Vuosi: " . $sqltiedot3[0][3] . " Periodi: " . $sqltiedot3[0][4] . ")" . "<br>";
                }
                print "<br><br>";
                print "Päättyneet omat kurssikyselyt:<br>";
                $sqlk = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE and henkiloid = ? ORDER BY kknimi';
                $sqlk2 = $yhteys->prepare($sqlk);
                $sqlk2->execute(array($_GET["yhteenveto"]));
                $tauluk = $sqlk2->fetchAll();
                foreach ($tauluk as $tulos) {
                    // Haetaan kurssikyselyyn liittyvä henkiloid
                    $sqltk = 'SELECT henkiloid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetch();
                    // Haetaan henkilön etunimi, sukunimi, kurssinnimi, vuosi ja periodi henkiloid:n avulla
                    $sqltiedot = 'SELECT etunimi, sukunimi, nimi, vuosi, periodi FROM Henkilo INNER JOIN Kurssi ON kurssi.henkiloid = henkilo.henkiloid WHERE kurssi.henkiloid = ?';
                    $sqltiedot2 = $yhteys->prepare($sqltiedot);
                    $sqltiedot2->execute(array($sqltk3[0]));
                    $sqltiedot3 = $sqltiedot2->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                            " (" . $sqltiedot3[0][0] . " " . $sqltiedot3[0][1] . " - " . $sqltiedot3[0][2] . " - Vuosi: " . $sqltiedot3[0][3] . " Periodi: " . $sqltiedot3[0][4] . ")" . "<br>";
                }
            }
            ?>
        </ul>
        <ul class="navbar">
            <li><p><a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['yhteenveto']; ?>>Oma sivu</a></p>
        </ul>
        <?php
    }
    // Istuntotarkastus failaa
    else {
        header("Location: access_denied.php");
    }
    ?>
</body>
