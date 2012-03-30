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
            ?>
       </body>
