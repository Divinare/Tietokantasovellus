<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Henkilön lisäys</title>
   <meta charset="utf-8">
</head>

   <body>

   <?php
   $yhteys = db::getDB();
   //heataan henkilön vanha salasana tietokannasta:
   $sql = 'SELECT salasana FROM henkilo WHERE henkiloid =?';
   $sala = $yhteys->prepare($sql);
   $sala->execute(array($_GET['svaihto']));
   $vsala = $sala->fetchAll();

   if (empty($_POST['vanha'])) {
   header('Location: lomakesivu.php?viesti=Vanha%salasana%tyhjä'); die();
   }
   if (empty($_POST['uusi'])) {
   header('Location: lomakesivu.php?viesti=Ensimmäinen%salasana%puuttui'); die();
   }
   if (empty($_POST['uusi2'])) {
   header('Location: lomakesivu.php?viesti=Toinen%salasana%puuttui'); die();
   }
   if (strlen($_POST['uusi']) > 30) {
   header('Location: lomakesivu.php?viesti=uusi%salasana%liian%pitkä'); die();
   }
   if ($_POST['vanha'] != $vsala[0][0]) {
   header('Location: lomakesivu.php?viesti=vanha%salasana%oli%väärä'); die();
   }
   if ($_POST['uusi'] != $_POST['uusi2']) {
   header('Location: lomakesivu.php?viesti=uudet%salasanat%eivät%olleet%samoja'); die();
   }
   ?>
   <h2>Salasanan vaihto onnistui!</h2>

   <?php
   $sqlsala = 'UPDATE Henkilo SET salasana = ? WHERE henkiloID = ?';
   $sqlsala2 = $yhteys->prepare($sqlsala);
   $sqlsala2->execute(array($_POST['uusi'], $_GET['svaihto']));
   ?>

    <p> <a href=admin.php?admin=<?php print $_GET['svaihto']; ?>>Takaisin</a></p>

   </body>
