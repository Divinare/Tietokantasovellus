<?php
       require_once 'DB.php';
       $yhteys = db::getDB();
       $poistettavaid = $_POST["poisto"];

       // Poistetaan
       $sql2 = 'DELETE FROM Vastaus WHERE kurssikyselyID = ?';
       $poisto2 = $yhteys->prepare($sql2);
       $poisto2->execute(array($poistettavaid));

       $sql3 = 'DELETE FROM Kommentti WHERE kurssikyselyID = ?';
       $poisto3 = $yhteys->prepare($sql3);
       $poisto3->execute(array($poistettavaid));

       $sql0 = 'DELETE FROM Kysymys WHERE kurssikyselyID = ?';
       $poisto0 = $yhteys->prepare($sql0);
       $poisto0->execute(array($poistettavaid));

       $sql1 = 'DELETE FROM Kurssikysely WHERE kurssikyselyID = ?';
       $poisto1 = $yhteys->prepare($sql1);
       $poisto1->execute(array($poistettavaid));

       header("Location: opettaja.php?opettaja=".$_GET["opettaja"]); die();
   ?>
