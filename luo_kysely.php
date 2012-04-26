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
          $knimi = $_SESSION["knimi"];
          unset($_SESSION["knimi"]);
          $peri = $_SESSION["periodi"];
          unset($_SESSION["periodi"]);
          $vuosi = $_SESSION["vuosi"];
          unset($_SESSION["vuosi"]);


          // Tarkastetaan, onko kurssi jo olemassa
          $sql1 = 'SELECT kurssiID FROM Kurssi WHERE nimi = ? AND periodi = ? AND vuosi = ? AND henkiloID = ?';
          $onko = $yhteys->prepare($sql1);
          $onko->execute(array($knimi, $peri, $vuosi, $_GET["opettaja"]));
          $tulos = $onko->fetchAll();

          // Jos ei, niin lisätään
          if (sizeof($tulos)<1) {

             $sql = 'INSERT INTO Kurssi VALUES (?, ?, ?, ?) RETURNING kurssiID';
             $lisays = $yhteys->prepare($sql);
             $lisays->execute(array($_GET["opettaja"], $knimi, $peri, $vuosi));
          }

          // Valitun/lisätyn kurssin ID
          $sql2 = 'SELECT kurssiID FROM Kurssi WHERE nimi = ? AND periodi = ? AND vuosi = ? AND henkiloID = ?';
          $id = $yhteys->prepare($sql2);
          $id->execute(array($knimi, $peri, $vuosi, $_GET["opettaja"]));
          $idtulos = $id->fetch();

          // Uuden kurssikyselyn luonti
          $sql3 = "INSERT INTO Kurssikysely VALUES (?, '(oletus)', ?, False, False) RETURNING kurssikyselyID";
          $lisays2 = $yhteys->prepare($sql3);
          $lisays2->execute(array($idtulos[0], $_GET["opettaja"]));
          $kkid = $lisays2->fetch();

          header("Location: uusi.php?opettaja=".$_GET["opettaja"]."&kyselyid=".$kkid[0]); die();
       }
       else {
          header("Location: access_denied.php"); die();
       }
   ?>
</body>
