<?php require_once 'DB.php';

       $yhteys = db::getDB();

       if (strlen($_POST["ukysymys"]) > 1) {

          // Uuden kysymyksen lisääminen tietokantaan
          $ukysymys = $_POST["ukysymys"];
          $sql0 = 'INSERT INTO Kysymys VALUES (?, ?)';
          $lisays = $yhteys->prepare($sql0);
          $lisays->execute(array($ukysymys, $_GET["kyselyid"]));

          header("Location: muokkaa.php?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']."&viesti=OK!"); die();

       }
       else {

          header("Location: muokkaa.php?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']."&viesti=yhyy"); die();

       }
   ?>
