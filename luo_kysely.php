<?php
   // Tämä tiedosto luo kurssikyselyn
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

          $idtulos = $_SESSION["idtulos"];
          unset($_SESSION["idtulos"]);

          // Uuden kurssikyselyn luonti
          $sql3 = "INSERT INTO Kurssikysely VALUES (?, '(oletus)', ?, False, False)";
          $lisays2 = $yhteys->prepare($sql3);
          $lisays2->execute(array($idtulos, $_GET["opettaja"]));

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
