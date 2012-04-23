<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Yhteenveto</title>
   <meta charset="utf-8">
</head>

<body>
       <h2>Yhteenveto</h2></br>
       <?php
             $yhteys = db::getDB();

             $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely ORDER BY kknimi';
             foreach ($yhteys->query($kysely) as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid']."&henkiloid=".$_GET['yhteenveto'].">".$tulos['kknimi']."</a>"."</br>";
             }

      $sqlrooli = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
      $sqlrooli2 = $yhteys->prepare($sqlrooli);
      $sqlrooli2->execute(array($_GET["yhteenveto"]));
      $rooli = $sqlrooli2->fetch();
      ?>
     <p><a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['yhteenveto']; ?>>Takaisin</a></p>

</body>
