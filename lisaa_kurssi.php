<?php
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

          $minne = $_SESSION["minne"];
          unset($_SESSION["minne"]);

          if (isset($_SESSION["knimi"])) {
             $knimi = $_SESSION["knimi"];
             unset($_SESSION["knimi"]);
          }
          else {
             $knimi = $_POST["knimi"];
          }

          if (isset($_SESSION["periodi"])) {
             $peri = $_SESSION["periodi"];
             unset($_SESSION["periodi"]);
          }
          else {
             $peri = $_POST["periodi"];
          }

          if (isset($_SESSION["vuosi"])) {
             $vuosi = $_SESSION["vuosi"];
             unset($_SESSION["vuosi"]);
          }
          else {
             $vuosi = $_POST["vuosi"];
          }


          // Tarkastetaan, onko kurssi jo olemassa
          $sql1 = 'SELECT kurssiID FROM Kurssi WHERE nimi = ? AND periodi = ? AND vuosi = ? AND henkiloID = ?';
          $onko = $yhteys->prepare($sql1);
          $onko->execute(array($knimi, $peri, $vuosi, $_GET["opettaja"]));
          $tulos = $onko->fetchAll();


          // Jos ei, niin lisätään
          if (sizeof($tulos)<1) {

             $sql = 'INSERT INTO Kurssi VALUES (?, ?, ?, ?)';
             $lisays = $yhteys->prepare($sql);
             $lisays->execute(array($_GET["opettaja"], $knimi, $peri, $vuosi));
          }

          // Valitun/lisätyn kurssin ID
          $sql2 = 'SELECT kurssiID FROM Kurssi WHERE nimi = ? AND periodi = ? AND vuosi = ? AND henkiloID = ?';
          $id = $yhteys->prepare($sql2);
          $id->execute(array($knimi, $peri, $vuosi, $_GET["opettaja"]));
          $idtulos = $id->fetch();

          $_SESSION["idtulos"] = $idtulos[0];

          header("Location: ".$minne."?opettaja=".$_GET["opettaja"]);
}
else {
          header("Location: access_denied.php");
          die();
}

?>
