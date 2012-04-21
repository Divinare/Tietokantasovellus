<?php
       require_once 'DB.php';
       session_start();
       $yhteys = db::getDB();

       if ($_SESSION["ihminen"] == $_GET["opettaja"]) {


          if ($_GET["mista"] == "u") {
             $minne = "uusi.php";
          }
          else {
             $minne = "muokkaa.php";
          }
          $syote = $_POST["ukysymys"];
          if (strlen($syote) > 0 && strlen($syote) < 301) {

             // Uuden kysymyksen lisääminen tietokantaan
             $ukysymys = $_POST["ukysymys"];
             $sql0 = 'INSERT INTO Kysymys VALUES (?, ?)';
             $lisays = $yhteys->prepare($sql0);
             $lisays->execute(array($ukysymys, $_GET["kyselyid"]));

             header("Location: ".$minne."?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']."&viesti=OK!"); die();

          }
          else {

             $p = strlen($syote);
             header("Location: ".$minne."?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']."&viesti=yhyy&p=".$p); die();

          }
       }
       else {
          header("Location: access_denied.php"); die();
     }
   ?>
