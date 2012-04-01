<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Opettaja - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid ='.$_GET["opettaja"];
          $kyselyopettaja = $yhteys->prepare($sql);
          $kyselyopettaja->execute();
          $nimi = $kyselyopettaja->fetch();
          echo "<h1>Opettaja - $nimi[0] $nimi[1]</h1>";
          ?>
       </body>
