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
        $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid = ?';
        $kyselytitle = $yhteys->prepare($sql);
        $kyselytitle->execute(array($_GET["kysely"]));
        $htmltitle = $kyselytitle->fetch();
    ?>
        <title><?php print $htmltitle['kknimi'] ?></title>

</head>
<body>
    <?php

        // Arvosanat tauluun
        for ($i = 0, $size = sizeof($arvosanat); $i < $size; ++$i) {

           $maara++;
           $sql3 = 'INSERT INTO vastaus VALUES  (?, ?)';
           $insertti = $yhteys->prepare($sql3);
           $insertti->execute(array($kysymysidt[$i], $arvosanat[$i]));
        }

        // Kommentit tauluun
        for ($k = 0, $ksize = sizeof($kommentit); $k < $ksize; ++$k) {

          if (!$kommentit[$k] == "") {
           $kmaara++;
           $sql4 = 'INSERT INTO kommentti VALUES (?, ?)';
           $kinsertti = $yhteys->prepare($sql4);
           $kinsertti->execute(array($kommentit[$k], $kysymysidt[$k]));
          }
        }

        // Kiittelyteksti
        $sqlkurssi = 'SELECT nimi FROM kurssi INNER JOIN kurssikysely ON kurssikysely.kurssiid = kurssi.kurssiid WHERE kurssikysely.kurssikyselyid ='.$_GET["kysely"];
        $kurssi = $yhteys->prepare($sqlkurssi);
        $kurssi->execute();
        $kurssinnimi = $kurssi->fetch();
    ?>
    </br></br> <p>Kiitos vastaamisestasi kurssin <?php print $kurssinnimi['nimi']; ?> kurssikyselyyn!</p>

</body>

