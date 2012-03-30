<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <?php
     echo "<title>".$_GET["kysely"]."</title>";
    ?>
   <meta charset="utf-8">
</head>
       <body>

          <?php
             $yhteys = db::getDB();
             echo "<h1>".$_GET["kysely"]."</h1>";

             $idkysely = $yhteys->prepare('select kysymys from kysymys inner join kurssikysely on kysymys.kurssikyselyid = kurssikysely.kurssikyselyid where kknimi = ?');
             $idkysely->execute(array($_GET["kysely"]));

             $tulokset = $idkysely->fetchAll();

	     foreach($tulokset as $tulos) {
               echo $tulos['kysymys']."</br>";
             }
            ?>
       </body>
