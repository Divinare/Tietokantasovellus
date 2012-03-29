<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Kurssikyselyn nimi </title>
  </head>
  <body>
   <h1>GreippiKysely</h1>
   <p>
   <h5>kurssikyselyn nimi</h3>
   <?php
   $yhteys = DB::getDB();
   $query = $yhteys->prepare('select kysymys from kurssikysely');
   $query->execute();
   $tulokset = $query->fetchAll();
   print_r($tulokset);
   ?>
    </p>
  </body>
</html>

