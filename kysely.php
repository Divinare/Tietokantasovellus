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

             $nimi = $_GET["kysely"];
             $idkysely = $yhteys->prepare('select kurssikyselyid from kurssikysely where kknimi = ?');
             $idkysely->execute(array($_GET["kysely"]));
            
	     $kysely = $yhteys->prepare('select kysymys from kysymys where kurssikyselyid = ?');
             $kysely->execute(array($idkysely));
             $tulokset = $kysely->fetchAll();

	     foreach($tulokset as $tulos) {
               echo $tulos['kysymys']."</br>";
             }
            ?>
       </body>
