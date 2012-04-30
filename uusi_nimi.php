<?php

    require_once 'DB.php';
    session_start();
    $yhteys = db::getDB();

    if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

       $pituus = strlen($_POST["kknimi"]);


       if ($_GET["mista"] == u) {
         $minne = "uusi.php";
       }
       else {
         $minne = "muokkaa.php";
       }

       if ($pituus > 0 && $pituus < 51) {


          // Otsikon uudelleennimeäminen
          $sqlnimi = 'UPDATE Kurssikysely SET kknimi = ? WHERE kurssikyselyID = ?';
          $unimi = $yhteys->prepare($sqlnimi);
          $unimi->execute(array($_POST["kknimi"], $_GET["kyselyid"]));


          header("Location: ".$minne."?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']."&viestiots=OK!"); die();
      }

      else {

          header("Location: ".$minne."?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']."&viestiots=yhyy&p=".$pituus); die();
      }
   }
   else {
      header("Location: access_denied.php"); die();
   }
?>

