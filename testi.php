<?php
    require_once 'DB.php';
?>
<!DOCTYPE html>

<head>
   <title>Pelkkää testailua</title>
   <meta charset="utf-8">
</head>
<body>
<?php

          $yhteys = db::getDB();


          $kyselysql = 'SELECT kurssikyselyid, kknimi, esilla, henkiloid FROM Kurssikysely WHERE esilla = TRUE and henkiloid = 3 ORDER BY kknimi';
          $kyselysql2 = $yhteys->prepare($kyselysql);
          $kyselysql2->execute(array());
          $taulu = $kyselysql2->fetch();
          print $taulu;




?>
