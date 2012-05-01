<?php
require_once 'DB.php';
session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
   <title>Vastuuhenkilö</title>
   <meta charset="utf-8">
</head>
<body>
       <?php
       if ($_SESSION["ihminen"] == $_GET["vastuuhenkilö"]) {


          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
          $kyselyadmin = $yhteys->prepare($sql);
          $kyselyadmin->execute(array($_GET["vastuuhenkilö"]));
          $nimi = $kyselyadmin->fetch();
          echo "<h1>Laitoksen vastuuhenkilö - $nimi[0] $nimi[1]</h1>";
          ?>

       <ul class="navbar">

          <li><p><a href=yhteenveto.php?yhteenveto=<?php print $_GET["vastuuhenkilö"]; ?>>Kaikkien kurssikyselyiden tulokset</a></p>

	  <li><p><a href=vaihdasala.php?vaihdasala=<?php print $_GET["vastuuhenkilö"]; ?>>Salasanan vaihto</a></p>

          <li><p><a href=kulos.php>Kirjaudu ulos</a></p>

      </ul>

       <?php
       }

       else {
          header("Location: access_denied.php"); die();
       }
       ?>
</body>
