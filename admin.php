<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Admin - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
          $kyselyadmin = $yhteys->prepare($sql);
          $kyselyadmin->execute(array($_GET["admin"]));
          $nimi = $kyselyadmin->fetch();
          echo "<h1>Admin - $nimi[0] $nimi[1]</h1>";



	  ?>
	  <FORM METHOD="LINK" ACTION="hlisays.php">
	  <INPUT TYPE="submit" VALUE="Henkilön lisäys järjestelmään">
	  </FORM>
       </body>
