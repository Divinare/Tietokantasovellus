<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Yhteenveto - Greippikysely</title>
   <meta charset="utf-8">
</head>

<body>
       <h2>Käynnissä olevat kurssikyselyt</h2></br>
       <?php
             $yhteys = db::getDB();

             $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely ORDER BY kknimi';
             foreach ($yhteys->query($kysely) as $tulos) {
                print "<a href=luoyv.php?luoyv=".$tulos['kurssikyselyid'].">".$tulos['kknimi']."</a>"."</br>";
             }

       ?>


</body>
