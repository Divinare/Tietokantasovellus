<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       $yhteys = db::getDB();

       //Kysymyksen poisto
       $sql = 'DELETE FROM Temp WHERE uusiID = ?';
       $poisto = $yhteys->prepare($sql);
       $poisto->execute(array($_GET["remv"]));

       // Uuden kysymyksen lisääminen tietokantaan
       $ukysymys = $_POST["ukysymys"];
       $sql0 = 'INSERT INTO Temp VALUES (?, ?)';
       $lisays = $yhteys->prepare($sql0);
       $lisays->execute(array($ukysymys, $_GET["opettaja"]));

       // Uuden kyselyn jo olemassa olevien kysymysten haku
       $sql1 = 'SELECT uusikysymys, uusiID FROM Temp WHERE opeID = ?';
       $uusi = $yhteys->prepare($sql1);
       $uusi->execute(array($_GET["opettaja"]));
       $uudet = $uusi->fetchAll();

   ?>
   <h2>Uusi kysely</h2>

   <table border="0" cellpadding="3">

        <tr>
        <?php
          for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
        ?>

        <td><?php print $uudet[$i]['uusikysymys'];?></td>
        <td><a href=uusi.php?opettaja=<?php print $_GET["opettaja"];?>&&remv=<?php print $uudet[$i]['uusiid'];?>>Poista</a>

        </tr>

       <?php } ?>
       </table>


       </br></br>


       <FORM action="uusi.php?opettaja=<?php print $_GET['opettaja'];?>" method="post">
       Uusi kysymys: <input type="text" name="ukysymys">
       <input type="submit" value="Lisää">
       </FORM>
</body>
