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
                $bo = TRUE;
             }
             else {
                $tila = 'Piilossa';
                $bo = FALSE;
             }

        ?>

        <td><?php print $k['kknimi'];?></td>
        <td><?php print $tila;?></td>
        <td><FORM action="muokkaa.php?opettaja=<?php print $_GET['opettaja'];?>&kyselyid=<?php print $k['kurssikyselyid'];?>" method="post">
            <input type="hidden" name="tila" value="<?php print $bo;?>">
            <input type="submit" value="Muokkaa">
            </FORM>
        </tr>

        <?php } ?>

        </table>
        <p> <a href=valitse_kurssi.php?opettaja=<?php print $_GET["opettaja"]; ?>>Luo uusi kysely</a></p>

        <p> <a href=vaihdasala.php?vaihdasala=<?php print $_GET["opettaja"]; ?>>Salasanan vaihto</a></p>
</body>

