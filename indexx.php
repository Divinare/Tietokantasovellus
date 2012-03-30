<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Kurssikysely </title>
   <meta charset="utf-8">
</head>
        <body>

          <?php
             $yhteys = db::getDB();
             echo "Voimassa olevat kurssikyselyt" . "</br>";
             $kysely = $yhteys->prepare('select kurssikysely.kknimi from kurssi$
             $kysely->execute();
             $tulokset = $kysely->fetchAll();

             foreach($tulokset as $tulos) {
               echo $tulos['kknimi'] . "</br>";
             }

            ?>
       </body>

