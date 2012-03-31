<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Admin - Greippikysely</title>;
   <meta charset="utf-8">
</head>
       <body>
          <?php
            echo "<h1>".htmltitle['kknimi']."</h1>";

            $kysely = 'SELECT kysymys FROM kysymys WHERE kurssikyselyid ='.$_GET["kysely"];
            foreach ($yhteys->query($kysely) as $tulos) {
                print $tulos['kysymys']."</br>";
            }
          ?>
       </body>
