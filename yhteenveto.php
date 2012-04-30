<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<head>
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

        if ($rooli[0] == vastuuhenkilö) {
             print "Käynnissä olevat kurssikyselyt:<br>";
             $kysely = 'SELECT kurssikyselyid, kknimi, esilla FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';
             foreach ($yhteys->query($kysely) as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."<br>";
             }
             print "<br><br>"
             print "Päättyneet kurssikyselyt:<br>";
             $kysely2 = 'SELECT kurssikyselyid, kknimi, esilla, ollutEsilla FROM Kurssikysely WHERE esilla = FALSE and ollutEsilla = FALSE ORDER BY kknimi';
             foreach ($yhteys->query($kysely2) as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."<br>";
             }
        }

        if ($rooli[0] == opettaja) {

        }

      ?>
     <p><a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['yhteenveto']; ?>><img src="nuoli.png" border="0" /></a></p>

</body>
