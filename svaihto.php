<?php
    require_once 'DB.php';
    session_start();
?>
<!DOCTYPE html>

<head>
   <title>Henkilön lisäys</title>
   <meta charset="utf-8">
</head>

<body>

   <?php

     $yhteys = db::getDB();

     if ($_SESSION["ihminen"] == $_GET["svaihto"]) {
        // Haetaan henkilön vanha salasana tietokannasta
        $sql = 'SELECT salasana FROM henkilo WHERE henkiloid =?';
        $sala = $yhteys->prepare($sql);
        $sala->execute(array($_GET['svaihto']));
        $vsala = $sala->fetchAll();

        if ($_POST['vanha'] != $vsala[0][0]) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=vanhavaara"); die();
        }
        if (strlen($_POST['uusi']) > 15) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=salapitkä"); die();
        }
        if (strlen($_POST['uusi']) < 8) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=salalyhyt"); die();
        }
        if ($_POST['uusi'] != $_POST['uusi2']) {
            header("Location: vaihdasala.php?vaihdasala=".$_GET["svaihto"]."&viesti=salateitäsmää"); die();
        }
   ?>
   <h2>Salasanan vaihto onnistui!</h2>

   <?php

      $sqlsala = 'UPDATE Henkilo SET salasana = ? WHERE henkiloID = ?';
      $sqlsala2 = $yhteys->prepare($sqlsala);
      $sqlsala2->execute(array($_POST['uusi'], $_GET['svaihto']));


      $sql = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
      $kyselyrooli = $yhteys->prepare($sql);
      $kyselyrooli->execute(array($_GET["svaihto"]));
      $rooli = $kyselyrooli->fetch();

   ?>

   <p> <a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['svaihto']; ?>>Takaisin</a></p>

   <?php

     }
     else {
          header("Location: access_denied.php"); die();
     }

   ?>

</body>
