
<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Kurssikysely </title>
   <meta charset="utf-8">
</head>
        <body>

          <?php
             $yhteys = db::getDB();
             echo "<h1>Käynnissä olevat kurssikyselyt</h1></br>";
             $kysely = $yhteys->prepare('select kurssikysely.kknimi from kurssikysely');
             $kysely->execute();
             $tulokset = $kysely->fetchAll();

             foreach($tulokset as $tulos) {
               echo "<a href=http://jelindh.users.cs.helsinki.fi/kysely.php?kysely=".$tulos['kknimi'].">".$tulos['kknimi']."</a>"."</br>";
             }

            ?>
        </body>
