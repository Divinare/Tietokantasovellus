<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Kyselyn muokkaus</title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       $yhteys = db::getDB();

       // Otsikon uudelleennimeäminen
       $sqlnimi = 'UPDATE Kurssikysely SET kknimi = ? WHERE kurssikyselyID = ?';
       $unimi = $yhteys->prepare($sqlnimi);
       $unimi->execute(array($_POST["kknimi"], $_GET["kyselyid"]));

       // Kyselyn nimi ja tila
       $sqlo = 'SELECT kknimi, esilla FROM Kurssikysely WHERE kurssikyselyID = ?';
       $otsikko = $yhteys->prepare($sqlo);
       $otsikko->execute(array($_GET["kyselyid"]));
       $otsikkov = $otsikko->fetch();

       // Uuden kyselyn jo olemassa olevien kysymysten haku
       $sql1 = 'SELECT kysymys, kysymysID FROM Kysymys WHERE kurssikyselyID = ?';
       $uusi = $yhteys->prepare($sql1);
       $uusi->execute(array($_GET["kyselyid"]));
       $uudet = $uusi->fetchAll();

       //  Mihin kurssiin kysely liittyy
       $sqlkurssi = 'SELECT nimi, vuosi, periodi FROM Kurssi INNER JOIN Kurssikysely ON Kurssikysely.kurssiID = Kurssi.kurssiID WHERE kurssikyselyID = ?';
       $kurssinimi = $yhteys->prepare($sqlkurssi);
       $kurssinimi->execute(array($_GET["kyselyid"]));
       $kntulos = $kurssinimi->fetch();

   ?>

   <!-- Otsikko ja sen muuttaminen -->
   <h2>Kurssin <?php print $kntulos['nimi'];?> (<?php print $kntulos['periodi'];?>/<?php print $kntulos['vuosi'];?>) kurssikysely</h2>
   <p><b><?php print $otsikkov['kknimi']; ?></b></p>

   <form action="muokkaa.php?opettaja=<?php print $_GET['opettaja'];?>&kyselyid=<?php print $_GET['kyselyid'];?>" method="post">
   <input type="text" name="kknimi">
   <input type="submit" value = "Muuta nimeä">
   </form>  </br></br>


   <!-- Kyselyssä olevat kysymykset ja niiden poistolinkki-->
   <table border="0" cellpadding="3">
        <th align="left">Tallennetut kysymykset</th>
        <tr>
           <?php
                 for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
           ?>

              <td><?php print $uudet[$i]['kysymys'];?></td>
              <td><a href=kpoisto.php?opettaja=<?php print $_GET["opettaja"];?>&&remv=<?php print $uudet[$i]['kysymysid'];?>&&kyselyid=<?php print $_GET["kyselyid"];?>&mista=m>Poista</a>
        </tr>
           <?php } ?>
       </table>
       </br>

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
   <!-- Uuden kysymyksen lisääminen -->
   <FORM action="lisaa_kysymys.php?opettaja=<?php print $_GET['opettaja'];?>&kyselyid=<?php print $_GET['kyselyid'];?>&mista=m" method="post">
      <input type="text" name="ukysymys">
      <input type="submit" value="Lisää kysymys">
   </FORM>  </br></br>

   <!-- Kyselyn tila (näkyvyys) -->
   <?php
         if ($otsikkov['esilla']) {
            $tila = "Julkaistu";
            $bo = FALSE;
         }
         else {
            $tila = "Piilossa";
            $bo = TRUE;
         }
   ?>
   <p><b>Kyselyn tila: </b><?php print $tila;?></p>
   <FORM action="muuta_tila.php?opettaja=<?php print $_GET['opettaja'];?>&kyselyid=<?php print $_GET['kyselyid'];?>" method="post">
        <input type="hidden" name="tila" value="<?php print $bo;?>">
        <input type="submit" value="Muuta">
   </FORM>

   <!-- Kyselyn poistaminen --!>
   <p><b>Kyselyn poisto<b></p>
    <FORM action="poisto.php?opettaja=<?php print $_GET['opettaja'];?>" method="post">
        <input type="hidden" name="poisto" value="<?php print $_GET['kyselyid'];?>">
        <input type="submit" value="Poista">
    </FORM> </br></br>

   <!-- Paluulinkki -->
   <a href=opettaja.php?opettaja=<?php print $_GET["opettaja"];?>>Takaisin</a>

</body>
