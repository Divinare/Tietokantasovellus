<?php
    require_once 'DB.php';
    session_start();
?>
<!DOCTYPE html>

<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       $yhteys = db::getDB();

       if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

          // Kyselyn otsikko/nimi
          $sqlo = 'SELECT kknimi FROM Kurssikysely WHERE kurssikyselyID = ?';
          $otsikko = $yhteys->prepare($sqlo);
          $otsikko->execute(array($_GET["kyselyid"]));
          $otsikkov = $otsikko->fetch();

          // Uuden kyselyn jo olemassa olevien kysymysten haku
          $sql1 = 'SELECT kysymys, kysymysID FROM Kysymys WHERE kurssikyselyID = ?';
          $uusi = $yhteys->prepare($sql1);
          $uusi->execute(array($_GET["kyselyid"]));
          $uudet = $uusi->fetchAll();
   ?>

   <!-- Otsikon säätämistä -->
   <h2><?php print $otsikkov[0]; ?></h2>

   <?php
          $viesti = $_GET["viestiots"];
          if ($viesti == "OK!") {
             print "OK!";
          }
          else if ($viesti == "yhyy") {
             print "<font color='red'>Otsikon sallittu pituus 1-50 merkkiä - antamasi pituus oli ".$_GET["p"].".";
          }
   ?>
   <font color='black'>
   <form action="uusi_nimi.php?opettaja=<?php print $_GET['opettaja'];?>&&kyselyid=<?php print $_GET['kyselyid'];?>&mista=u" method="post">
   <input type="text" name="kknimi">
   <input type="submit" value = "Muuta nimeä">
       </form>
       </br></br>

   <!-- Kysymystaulu -->
   <table border="0" cellpadding="3">
   <th align="left">Tallennetut kysymykset</th>
        <tr>
        <?php
          for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
        ?>

              <td><?php print $uudet[$i]['kysymys'];?></td>

   <!-- Kysymyksen poisto -->
              <td><a href=kpoisto.php?opettaja=<?php print $_GET["opettaja"];?>&&remv=<?php print $uudet[$i]['kysymysid'];?>&&kyselyid=<?php print $_GET["kyselyid"];?>&mista=u>Poista</a>
              </tr>
       <?php } ?>
       </table>
       </br></br>

  <!-- Uuden kysymyksen lisääminen -->

       <?php
          if ($_GET["viesti"] == "OK!") {
              print "OK!";
          }

          else if ($_GET["viesti"] == "yhyy") {
              print "<font color='red'>Kysymyksen sallittu pituus 1-300 merkkiä - antamasi pituus oli ".$_GET["p"].".";?>
              <font color='black'>
       <?php
          }
       ?>

       <FORM action="lisaa_kysymys.php?opettaja=<?php print $_GET['opettaja'];?>&kyselyid=<?php print $_GET['kyselyid'];?>&mista=u" method="post">
       <input type="text" name="ukysymys">
       <input type="submit" value="Lisää kysymys">
       </FORM>
       </br></br>


  <!-- POIS! -->
  <a href=opettaja.php?opettaja=<?php print $_GET["opettaja"];?>>Takaisin</a>

  <?php

    }
    else {
        header("Location: access_denied.php"); die();
     }
  ?>

</body>
