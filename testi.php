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

          // Valitaan opettajan luomat kyselyt
          $sql2 = 'SELECT kknimi, esilla, kurssikyselyID, nimi FROM kurssikysely INNER JOIN kurssi ON kurssi.kurssiid = kurssikysely.kurssiid WHERE henkiloID = 6';
          $kkyselyt = $yhteys->prepare($sql2);
          $kkyselyt->execute(array());
          $kyselyt = $kkyselyt->fetchAll();


print "Koko ".sizeof($kyselyt)."<br>";
print "kknimi ".$kyselyt[0]["kknimi"];


?>
