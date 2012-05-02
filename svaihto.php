<?php
    require_once 'DB.php';
    session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<head>
   <title>Salasanan vaihto</title>
   <meta charset="utf-8">
</head>

<body>

   <?php

     $yhteys = db::getDB();

     if ($_SESSION["ihminen"] == $_GET["svaihto"]) {

        // Haetaan henkilön vanha salasana tietokannasta
        $sql = 'SELECT salasana FROM henkilo WHERE henkiloid = ?';
        $sala = $yhteys->prepare($sql);
        $sala->execute(array($_GET["svaihto"]));
        $vsala = $sala->fetch();

        $tiiviste = md5(md5($_POST["vanha"]."greippejäomnomnom")."lisääsitruksia");

        if ($tiiviste != $vsala["salasana"]) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=vanhavaara"); die();
        }
        if (strlen($_POST["uusi"]) > 15) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=salapitkä"); die();
        }
        if (strlen($_POST["uusi"]) < 8) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=salalyhyt"); die();
        }
        if ($_POST["uusi2"] != $_POST["uusi2"]) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=salateitäsmää"); die();
        }
   ?>
   <h2>Salasanan vaihto onnistui!</h2>

   <?php

      $salasana = $_POST["uusi"];
      $tiiviste = md5(md5($salasana . "greippejäomnomnom")."lisääsitruksia");


      $sqlsala = 'UPDATE Henkilo SET salasana = ? WHERE henkiloID = ?';
      $sqlsala2 = $yhteys->prepare($sqlsala);
      $sqlsala2->execute(array($tiiviste, $_GET["svaihto"]));


      $sql = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
      $kyselyrooli = $yhteys->prepare($sql);
      $kyselyrooli->execute(array($_GET["svaihto"]));
      $rooli = $kyselyrooli->fetch();

   ?>

   <p> <a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET["svaihto"]; ?>><img src="nuoli.png" border="0" /></a></p>

   <?php

     }
     else {
          header("Location: access_denied.php"); die();
     }

   ?>

</body>
