<?php
    require_once 'DB.php';
    session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<head>
   <title>Opettaja - Greippikysely</title>
   <meta charset="utf-8">
</head>
  <body>
    <?php
       // Istuntotarkastus
       if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
          $kyselyopettaja = $yhteys->prepare($sql);
          $kyselyopettaja->execute(array($_GET["opettaja"]));
          $nimi = $kyselyopettaja->fetch();
         ?>
         <h1>Opettaja - <?php print $nimi[0]." ".$nimi[1];?></h1>

         <?php
          // Valitaan opettajan luomat kyselyt ja niiden kurssien tiedot
          $sql2 = 'SELECT kknimi, esilla, kurssikyselyID, nimi, periodi, vuosi FROM kurssikysely INNER JOIN kurssi ON kurssikysely.kurssiid = kurssi.kurssiid AND kurssi.henkiloid = kurssikysely.henkiloid WHERE kurssi.henkiloID = ? ORDER BY vuosi DESC, kknimi;';
          $kkyselyt = $yhteys->prepare($sql2);
          $kkyselyt->execute(array($_GET["opettaja"]));
          $kyselyt = $kkyselyt->fetchAll();

          if (sizeof($kyselyt) > 0) {
         ?>

          <h3>Omat kyselyt</h3>
          <table border="0" cellpadding="3">
            <tr>
                  <th align = left>Nimi</th>
                  <th align = left>Tila</th>
                  <th align = left>Kurssi</th>
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
        <td><?php print $k['nimi']." ".$k['periodi']."/".$k['vuosi'];?></td>
        <td><FORM action="muokkaa.php?opettaja=<?php print $_GET['opettaja'];?>&kyselyid=<?php print $k['kurssikyselyid'];?>" method="post">
            <input type="hidden" name="tila" value="<?php print $bo;?>">
            <input type="submit" value="Muokkaa">
            </FORM>
        </tr>

        <?php } ?>

        </table>

        <?php
        }
        else {
        ?>

        <h3>Omat kyselyt</h3>
          <table border="0" cellpadding="3">
            <tr>
                  <td>(tyhjä)</td>
            </tr>
          </table>
        <?php
        }
        ?>

        <p> <a href=valitse_kurssi.php?opettaja=<?php print $_GET["opettaja"]; ?>>Luo uusi kysely</a></p>

	<p> <a href=yhteenveto.php?yhteenveto=<?php print $_GET["opettaja"]; ?>>Kurssikyselyiden tulokset</a></p>

        <p> <a href=vaihdasala.php?vaihdasala=<?php print $_GET["opettaja"]; ?>>Salasanan vaihto</a></p>

        <p> <a href=kulos.php>Kirjaudu ulos</a></p>

        <?php
          }
          // Istuntotarkastus failaa
          else {
              header("Location: access_denied.php"); die();
          }
        ?>

</body>
