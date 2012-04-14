<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       $yhteys = db::getDB();

       $ukysymykset = $_POST["ukysymykset"];

          $sql0 = 'INSERT INTO Temp VALUES (?, ?)';
          $lisays = $yhteys->prepare($sql0);
          $lisays->execute(array($ukysymykset['uusikysymys'], $_GET["opettaja"]));


       $sql1 = 'SELECT uusiID, uusikysymys FROM temp WHERE henkiloID = ?';
       $uusi = $yhteys->prepare($sql1);
       $uusi->execute(array($_GET["opettaja"]));
       $uudet = $uusi->fetchAll();
   ?>
    <h2>Uusi kysely</h2>


    <table border="0" cellpadding="3">

        <tr>
        <?php

          foreach ($uudet as $u) {

        ?>

        <td><?php print $u['uusikysymys'];?></td>
        <td><a href=uusi.php?opettaja=<?php print $_GET["opettaja"];?>?remv=<?php print $u['uusiID'];?>>Poista</a>

        </tr>

       <?php } ?>
       </table>


       </br></br>


       <FORM action="uusi.php?opettaja=<?php print $_GET['opettaja'];?>" method="post">
       Uusi kysymys: <input type="text" name="ukysymykset">
       <input type="submit" value="Lisää">
       </FORM>
</body>
