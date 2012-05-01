<?php
// Luodaan opettajalle ja vastuuhenkilölle linkit käynnissä oleviin ja päättyneisiin kurssikyselyiden tuloksiin
require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<title>Yhteenveto</title>
<meta charset="utf-8">
</head>

<body>
<h2>Yhteenveto</h2></br>
<?php
        $yhteys = db::getDB();

        $sqlrooli = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
        $sqlrooli2 = $yhteys->prepare($sqlrooli);
        $sqlrooli2->execute(array($_GET["yhteenveto"]));
        $rooli = $sqlrooli2->fetch();

        // Vastuuhenkilö näkee kaikki kurssikyselyiden tulokset
        if ($rooli[0] == vastuuhenkilö) {
             print "Käynnissä olevat kurssikyselyt:<br>";
             $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';
             foreach ($yhteys->query($kysely) as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."<br>";
             }
             print "<br><br>";
             print "Päättyneet kurssikyselyt:<br>";
             $kysely2 = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE ORDER BY kknimi';
             foreach ($yhteys->query($kysely2) as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."<br>";
             }
        }

        // Opettaja näkee vain omien kurssikyselyiden tulokset
        if ($rooli[0] == opettaja) {
             print "Käynnissä olevat omat kurssikyselyt:<br>";
             $kyselysql = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE and henkiloid = ? ORDER BY kknimi';
             $kyselysql2 = $yhteys->prepare($kyselysql);
             $kyselysql2->execute(array($_GET["yhteenveto"]));
             $taulu = $kyselysql2->fetchAll();
             foreach ($taulu as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."<br>";
             }
             print "<br><br>";
             print "Päättyneet omat kurssikyselyt:<br>";
             $sqlk = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = TRUE and henkiloid = ? ORDER BY kknimi';
             $sqlk2 = $yhteys->prepare($sqlk);
             $sqlk2->execute(array($_GET["yhteenveto"]));
             $tauluk = $sqlk2->fetchAll();
             foreach ($tauluk as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."<br>";
             }
        }

      ?>
<p><a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['yhteenveto']; ?>><img src="nuoli.png" border="0" /></a></p>

</body>
