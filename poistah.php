<?php

    require_once 'DB.php';
    session_start();
    $yhteys = db::getDB();

    if ($_SESSION["ihminen"] == $_GET["admin"]) {

          print "olen täällä";
          //salasanan tsekkaus:
          $sqls = 'SELECT salasana FROM henkilo WHERE henkiloid = ?';
          $sqls2 = $yhteys->prepare($sqls);
          $sqls2->execute(array($_GET["henkiloid"]));
          $taulus = $sqls2->fetch();
          echo $taulus[0];
          //if ($_GET["poista"] == $taulus[0]) {
          //    header("Location: muokkaah.php?admin=".$_GET["muutah"]."&henkiloid=".$_GET["henkiloid"]."&viesti=ok"); die();
          // }
          //else {
          //header("Location: muokkaah.php?admin=".$_GET["muutah"]."&henkiloid=".$_GET["henkiloid"]."&viesti=salafail"); die();
          // }




   }
   else {
//   header("Location: access_denied.php"); die();
   }
?>
