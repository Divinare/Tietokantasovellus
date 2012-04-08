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
         ?>
         <h1>Opettaja - <?php print $nimi[0]." ".$nimi[1];?></h1>

         <?php
          $sql2 = 'SELECT kknimi, esilla, kurssikyselyID FROM kurssikysely WHERE henkiloID = ?';
          $kkyselyt = $yhteys->prepare($sql2);
          $kkyselyt->execute(array($_GET["opettaja"]));
          $kyselyt = $kkyselyt->fetchAll();
         ?>

          <h3>Omat kyselyt</h3>
          <table border="0" cellpadding="3">
            <tr>
                  <th align = left>Nimi</th>
                  <th align = left>Tila</th>
                  <th>  </th>
            </tr>
            <tr>

        <?php

          foreach ($kyselyt as $k) {

             if ($k['esilla']) {
                $tila = 'Julkaistu';
             }
             else {
                $tila = 'Piilossa';
             }

        ?>

        <td><?php print $k['kknimi'];?></td>
        <td><?php print $tila;?></td>
        <td><a href=muokkaa.php?kysely=<?php print $k['kurssikyselyid']; ?>>Muokkaa</a>

        </tr>  

        <?php } ?>

        </table>
        <p> <a href=uusi.php>Luo uusi kysely</a></p>

       <?php


// tila
// julkaise
// sulje
// uusi





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
