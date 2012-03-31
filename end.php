<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

  <head>
      <meta charset="utf-8">
      <?php
        $yhteys = db::getDB();

     // Äskeiseltä sivulta lähetetyt
        $arvosanat = $_POST["arvosana"];
        $kommentit = $_POST["kommentti"];
        $kysymysidt = $_POST["kysymysidt"]; 

     // Vastausten lisääminen tauluun

        // Ensin lasketaan Vastaus-taulussa olevien vastausten lkm
        $sql1 = 'SELECT COUNT(vastausid) FROM vastaus';
        $vastaustenlkm = $yhteys->prepare($sql1);
        $vastaustenlkm->execute();
        $maarataulu = $vastaustenlkm->fetch();
        $maara = $maarataulu[0]; // <--- Nykyinen vastausten määrä, uudet ID:t sen perusteella (ID on vastauksen järjestysnumero...)!

        // Ja tauluun...
        for ($i = 0, $size = sizeof($arvosanat); $i < $size; ++$i) {

           $maara++;
           $sql2 = 'INSERT INTO vastaus VALUES ('.$maara.', '.$kysymysidt[$i].', '.$arvosanat[$i].')';
           $insertti = $yhteys->prepare($sql2);
           $insertti->execute();
        }

//// HUOM, KOMMENTTEJA EI VIELÄ KÄSITELTY!!!

        // Palkkiotsikon säätöä :P
        $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid ='.$_GET["kysely"];
        $kyselytitle = $yhteys->prepare($sql);
        $kyselytitle->execute();
        $htmltitle = $kyselytitle->fetch();
        echo "<title>".$htmltitle['kknimi']."</title>";
      ?>
  </head>
  <body>
    <?php
      // Kiittelyteksti
      $sqlkurssi = 'SELECT nimi FROM kurssi INNER JOIN kurssikysely ON kurssikysely.kurssiid = kurssi.kurssiid WHERE kurssikysely.kurssikyselyid ='.$_GET["kysely"];
      $kurssi = $yhteys->prepare($sqlkurssi);
      $kurssi->execute();
      $kurssinnimi = $kurssi->fetch();
      print 'Kiitos vastaamisestasi kurssin '.$kurssinnimi['nimi'].' kurssikyselyyn!';
    ?>
  </body>
