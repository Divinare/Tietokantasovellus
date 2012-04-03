<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Opettaja - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
          $kyselyopettaja = $yhteys->prepare($sql);
          $kyselyopettaja->execute(array($_GET["opettaja"]));
          $nimi = $kyselyopettaja->fetch();
          print "<h1>Opettaja - $nimi[0] $nimi[1]</h1>";


          print "<h3>Omat kyselyt</h3>";
          $sql2 = 'SELECT kknimi FROM kurssikysely WHERE henkiloID = ?';
          $kkyselyt = $yhteys->prepare($sql2);
          $kkyselyt->execute(array($_GET["opettaja"]));
          $kyselyt = $kkyselyt->fetchAll();


          foreach ($kyselyt as $k) {
             print $k['kknimi']."</br>";

            
          }




// henkiloid | etunimi | sukunimi |          email          |    salasana    |  rooli
//-----------+---------+----------+-------------------------+----------------+----------
//         1 | Jenna   | Lindh    | jelindh@cs.helsinki.fi  | broileri       | admin
//         2 | Joe     | Niemi    | joeniemi@cs.helsinki.fi | apina          | admin
//        20 | Leidi   | Lol      | joeniemi@cs.helsinki.fi | haha           | opettaja
//        21 | Arto    | Wikla    | joeniemi@cs.helsinki.fi | roskienkeraaja | opettaja


// kurssikyselyid | kurssiid |   kknimi    | henkiloid
//----------------+----------+-------------+-----------
//          10000 |      123 | OhPe-kysely |        21
//          10001 |      124 | OhJa-kysely |        21
//          10002 |      125 | JFO-kysely  |        20
?>
</body>
