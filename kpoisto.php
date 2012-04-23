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


          $sql = 'DELETE FROM Kommentti WHERE kysymysID = ?';
          $poisto = $yhteys->prepare($sql);
          $poisto->execute(array($_GET["remv"]));

          $sqlv = 'DELETE FROM Vastaus WHERE kysymysID = ?';
          $poistov = $yhteys->prepare($sqlv);
          $poistov->execute(array($_GET["remv"]));

          $sqlk = 'DELETE FROM Kysymys WHERE kysymysID = ?';
          $poistok = $yhteys->prepare($sqlk);
          $poistok->execute(array($_GET["remv"]));

          header("Location: ".$minne."?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']); die();
     }
     else {
          header("Location: access_denied.php"); die();
     }
?>
