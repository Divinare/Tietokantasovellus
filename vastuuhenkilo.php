<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Admin - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
          $kyselyadmin = $yhteys->prepare($sql);
          $kyselyadmin->execute(array($_GET["vastuuhenkilo"]));
          $nimi = $kyselyadmin->fetch();
          echo "<h1>Laitoksen vastuuhenkilö - $nimi[0] $nimi[1]</h1>";
          ?>
          <p> <a href=vaihdasala.php?vaihdasala=<?php print $_GET["vastuuhenkilo"]; ?>>Salasanan vaihto</a></p>
       </body>
