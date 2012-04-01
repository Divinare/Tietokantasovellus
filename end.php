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

        // Palkkiotsikko
        $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid ='.$_GET["kysely"];
        $kyselytitle = $yhteys->prepare($sql);
        $kyselytitle->execute();
        $htmltitle = $kyselytitle->fetch();
        echo "<title>".$htmltitle['kknimi']."</title>";
      ?>
  </head>
  <body>
      <?php

	 // Vastausten lisääminen Kommentti-tauluun

        // Lasketaan Vastaus-taulussa olevien vastausten lkm
        $sql1 = 'SELECT COUNT(vastausid) FROM vastaus';
        $vastaustenlkm = $yhteys->prepare($sql1);
        $vastaustenlkm->execute();
        $maarataulu = $vastaustenlkm->fetch();
        $maara = $maarataulu[0]; // <--- Nykyinen vastausten määrä, uudet ID:t sen perusteella (ID on vastauksen järjestysnumero...)!

        // Lasketaan Kommentti-taulussa olevien kommenttien määrä
        $sql2 = 'SELECT count(kommenttiid) FROM kommentti';
        $kommlkm = $yhteys->prepare($sql2);
        $kommlkm->execute();
        $kmaarataulu = $kommlkm->fetch();
        $kmaara = $kmaarataulu[0]; // <--- Nykyinen kommenttimäärä!

        // Arvosanat tauluun
        for ($i = 0, $size = sizeof($arvosanat); $i < $size; ++$i) {

           $maara++;
           $sql3 = 'INSERT INTO vastaus VALUES ('.$maara.', '.$kysymysidt[$i].', '.$arvosanat[$i].')';
           $insertti = $yhteys->prepare($sql3);
           $insertti->execute();
        }

        // Kommentit tauluun
        for ($k = 0, $ksize = sizeof($kommentit); $k < $ksize; ++$k) {

          if (!$kommentit[$k] == "") {
           $kmaara++;
           $sql4 = "INSERT INTO kommentti VALUES (".$kmaara.", '".$kommentit[$k]."', ".$kysymysidt[$k].")";
           $kinsertti = $yhteys->prepare($sql4);
           $kinsertti->execute();
          }
        }

        // Kiittelyteksti
        $sqlkurssi = 'SELECT nimi FROM kurssi INNER JOIN kurssikysely ON kurssikysely.kurssiid = kurssi.kurssiid WHERE kurssikysely.kurssikyselyid ='.$_GET["kysely"];
        $kurssi = $yhteys->prepare($sqlkurssi);
        $kurssi->execute();
        $kurssinnimi = $kurssi->fetch();
        print 'Kiitos vastaamisestasi kurssin '.$kurssinnimi['nimi'].' kurssikyselyyn!';
      ?>
  </body>

