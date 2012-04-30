<?php
   // Tämä tiedosto lisää kantaan uuden kurssin, hakee sen tiedot uutta kurssikyselyä varten ja luo kurssikyselyn
   require_once 'DB.php';
   session_start();
?>

<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<head>
   <title>Uusi kysely - Kurssi</title>
   <meta charset="utf-8">
</head>
<body>
<?php
       if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

          $yhteys = db::getDB();

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

          // Uuden kurssikyselyn luonti
          $sql3 = "INSERT INTO Kurssikysely VALUES (?, '(oletus)', ?, False, False)";
          $lisays2 = $yhteys->prepare($sql3);
          $lisays2->execute(array($idtulos[0], $_GET["opettaja"]));

          // Kurssikyselyn ID:n hakeminen
          $sql4 = "SELECT LASTVAL()";
          $kkid = $yhteys->prepare($sql4);
          $kkid->execute();
          $kkidd = $kkid->fetch();

          header("Location: uusi.php?opettaja=".$_GET["opettaja"]."&kyselyid=".$kkidd[0]); die();

       }
       else {
          header("Location: access_denied.php"); die();
       }
   ?>
</body>
