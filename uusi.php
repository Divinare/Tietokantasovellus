<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       $yhteys = db::getDB();

       // Otsikon uudelleennimeäminen
       $sqlnimi = 'UPDATE Kurssikysely SET kknimi = ? WHERE kurssikyselyID = ?';
       $unimi = $yhteys->prepare($sqlnimi);
       $unimi->execute(array($_POST["kknimi"], $_GET["kyselyid"]));

       // Kyselyn otsikko/nimi
       $sqlo = 'SELECT kknimi FROM Kurssikysely WHERE kurssikyselyID = ?';
       $otsikko = $yhteys->prepare($sqlo);
       $otsikko->execute(array($_GET["kyselyid"]));
       $otsikkov = $otsikko->fetch();

       //Kysymyksen poisto
       $sql = 'DELETE FROM Kysymys WHERE kysymysID = ?';
       $poisto = $yhteys->prepare($sql);
       $poisto->execute(array($_GET["remv"]));

       // Uuden kysymyksen lisääminen tietokantaan
       $ukysymys = $_POST["ukysymys"];
       $sql0 = 'INSERT INTO Kysymys VALUES (?, ?)';
       $lisays = $yhteys->prepare($sql0);
       $lisays->execute(array($ukysymys, $_GET["kyselyid"]));

       // Uuden kyselyn jo olemassa olevien kysymysten haku
       $sql1 = 'SELECT kysymys, kysymysID FROM Kysymys WHERE kurssikyselyID = ?';
       $uusi = $yhteys->prepare($sql1);
       $uusi->execute(array($_GET["kyselyid"]));
       $uudet = $uusi->fetchAll();
   ?>

   <h2><?php print $otsikkov[0]; ?></h2>

   <form action="uusi.php?opettaja=<?php print $_GET['opettaja'];?>&&kyselyid=<?php print $_GET['kyselyid'];?>" method="post">
   <input type="text" name="kknimi">
   <input type="submit" value = "Muuta nimeä">
       </form>
       </br></br>

   <table border="0" cellpadding="3">
   <th align="left">Tallennetut kysymykset</th>
        <tr>
        <?php
          for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
        ?>

              <td><?php print $uudet[$i]['kysymys'];?></td>
              <td><a href=uusi.php?opettaja=<?php print $_GET["opettaja"];?>&&remv=<?php print $uudet[$i]['kysymysid'];?>&&kyselyid=<?php print $_GET["kyselyid"];?>>Poista</a>
              </tr>
       <?php } ?>
       </table>
       </br></br>

       <FORM action="uusi.php?opettaja=<?php print $_GET['opettaja'];?>&&kyselyid=<?php print $_GET['kyselyid'];?>" method="post">
       <input type="text" name="ukysymys">
       <input type="submit" value="Lisää kysymys">
       </FORM>
   </br></br>
   <a href=opettaja.php?opettaja=<?php print $_GET["opettaja"];?>>Takaisin</a>
</body>
