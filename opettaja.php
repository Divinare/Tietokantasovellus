<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Opettaja - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
          $kyselyopettaja = $yhteys->prepare($sql);
          $kyselyopettaja->execute(array($_GET["opettaja"]));
          $nimi = $kyselyopettaja->fetch();
          print "<h1>Opettaja - $nimi[0] $nimi[1]</h1>";


          print "<h3>Omat kyselyt</h3>";
          $sql2 = 'SELECT etunimi, sukunimi FROM opettaja INNER JOIN kurssikysely ON henkilo.henkiloID = kurssikysely.henkiloID':
          ?>
       </body>
