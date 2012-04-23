<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Vastuuhenkilö - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
          $kyselyadmin = $yhteys->prepare($sql);
          $kyselyadmin->execute(array($_GET["vastuuhenkilö"]));
          $nimi = $kyselyadmin->fetch();
          echo "<h1>Laitoksen vastuuhenkilö - $nimi[0] $nimi[1]</h1>";
          ?>

          <p> <a href=yhteenveto.php?yhteenveto=<?php print $_GET["vastuuhenkilö"]; ?>>Kurssikyselyiden tulokset</a></p>

	  <p> <a href=vaihdasala.php?vaihdasala=<?php print $_GET["vastuuhenkilö"]; ?>>Salasanan vaihto</a></p>

          <p> <a href=kulos.php>Kirjaudu ulos</a></p>

      </body>
