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
                    // Haetaan kurssikyselyyn liittyvä henkiloid ja kurssiid
                    $sqltk = 'SELECT henkiloid, kurssiid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
	            $sqltk3 = $sqltk2->fetchAll();
                    // Haetaan henkilön nimi henkiloID:n avulla (joka siis saadaan $sqltk3[0][0])
                    $sqln = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
                    $sqln2 = $yhteys->prepare($sqln);
                    $sqln2->execute(array($sqltk3[0][0]));
                    $sqln3 = $sqln2->fetchAll();
                    // Haetaan kurssin nimi, vuosi ja periodi kurssiID:n avulla (joka saadaan $sqltk3[0][1])
                    $sqlnpv = 'SELECT nimi, vuosi, periodi FROM kurssi WHERE kurssiid = ?';
                    $sqlnpv2 = $yhteys->prepare($sqlnpv);
                    $sqlnpv2->execute(array($sqltk3[0][1]));
                    $sqlnpv3 = $sqlnpv2->fetchAll();
                    // jos ei haluta copypaste koodia niin tämä:
                    //if ($_GET['kohta'] == 1) {
                    //header ("Location: haetiedot.php?henkiloid=".$_GET['yhteenveto']."&kurssikyselyid=".$tulos['kurssikyselyid'."&kohta=1"]);
                    //}
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                    " (".$sqln3[0][0] . " " . $sqln3[0][1] . " - " . $sqlnpv3[0][0] . " - Vuosi: " .$sqlnpv3[0][1] . " Periodi: " .$sqlnpv3[0][2] . ")" . "<br>";
                }
                print "<br><br>";
                print "Päättyneet kurssikyselyt:<br>";
                $kysely2 = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE ORDER BY kknimi';
                    // Haetaan kurssikyselyyn liittyvä henkiloid ja kurssiid
                    $sqltk = 'SELECT henkiloid, kurssiid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetchAll();
                    // Haetaan henkilön nimi henkiloID:n avulla (joka siis saadaan $sqltk3[0][0])
                    $sqln = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
                    $sqln2 = $yhteys->prepare($sqln);
                    $sqln2->execute(array($sqltk3[0][0]));
                    $sqln3 = $sqln2->fetchAll();
                    // Haetaan kurssin nimi, vuosi ja periodi kurssiID:n avulla (joka saadaan $sqltk3[0][1])
                    $sqlnpv = 'SELECT nimi, vuosi, periodi FROM kurssi WHERE kurssiid = ?';
                    $sqlnpv2 = $yhteys->prepare($sqlnpv);
                    $sqlnpv2->execute(array($sqltk3[0][1]));
                    $sqlnpv3 = $sqlnpv2->fetchAll();
                    foreach ($yhteys->query($kysely2) as $tulos) {
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                    " (".$sqln3[0][0] . " " . $sqln3[0][1] . " - " . $sqlnpv3[0][0] . " - Vuosi: " .$sqlnpv3[0][1] . " Periodi: " .$sqlnpv3[0][2] . ")" . "<br>";
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
                    // Haetaan kurssikyselyyn liittyvä henkiloid ja kurssiid
                    $sqltk = 'SELECT henkiloid, kurssiid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetchAll();
                    // Haetaan henkilön nimi henkiloID:n avulla (joka siis saadaan $sqltk3[0][0])
                    $sqln = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
                    $sqln2 = $yhteys->prepare($sqln);
                    $sqln2->execute(array($sqltk3[0][0]));
                    $sqln3 = $sqln2->fetchAll();
                    // Haetaan kurssin nimi, vuosi ja periodi kurssiID:n avulla (joka saadaan $sqltk3[0][1])
                    $sqlnpv = 'SELECT nimi, vuosi, periodi FROM kurssi WHERE kurssiid = ?';
                    $sqlnpv2 = $yhteys->prepare($sqlnpv);
                    $sqlnpv2->execute(array($sqltk3[0][1]));
                    $sqlnpv3 = $sqlnpv2->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                    " (".$sqln3[0][0] . " " . $sqln3[0][1] . " - " . $sqlnpv3[0][0] . " - Vuosi: " .$sqlnpv3[0][1] . " Periodi: " .$sqlnpv3[0][2] . ")" . "<br>";
                }
                print "<br><br>";
                print "Päättyneet omat kurssikyselyt:<br>";
                $sqlk = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE and henkiloid = ? ORDER BY kknimi';
                $sqlk2 = $yhteys->prepare($sqlk);
                $sqlk2->execute(array($_GET["yhteenveto"]));
                $tauluk = $sqlk2->fetchAll();
                foreach ($tauluk as $tulos) {
                    // Haetaan kurssikyselyyn liittyvä henkiloid ja kurssiid
                    $sqltk = 'SELECT henkiloid, kurssiid FROM kurssikysely WHERE kurssikyselyid = ?';
                    $sqltk2 = $yhteys->prepare($sqltk);
                    $sqltk2->execute(array($tulos['kurssikyselyid']));
                    $sqltk3 = $sqltk2->fetchAll();
                    // Haetaan henkilön nimi henkiloID:n avulla (joka siis saadaan $sqltk3[0][0])
                    $sqln = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
                    $sqln2 = $yhteys->prepare($sqln);
                    $sqln2->execute(array($sqltk3[0][0]));
                    $sqln3 = $sqln2->fetchAll();
                    // Haetaan kurssin nimi, vuosi ja periodi kurssiID:n avulla (joka saadaan $sqltk3[0][1])
                    $sqlnpv = 'SELECT nimi, vuosi, periodi FROM kurssi WHERE kurssiid = ?';
                    $sqlnpv2 = $yhteys->prepare($sqlnpv);
                    $sqlnpv2->execute(array($sqltk3[0][1]));
                    $sqlnpv3 = $sqlnpv2->fetchAll();
                    print "<a href=luoyv.php?luoyv=" . $tulos['kurssikyselyid'] . "&henkiloid=" . $_GET['yhteenveto'] . ">" . $tulos['kknimi'] . "</a>" .
                    " (".$sqln3[0][0] . " " . $sqln3[0][1] . " - " . $sqlnpv3[0][0] . " - Vuosi: " .$sqlnpv3[0][1] . " Periodi: " .$sqlnpv3[0][2] . ")" . "<br>";
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
