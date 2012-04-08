<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Henkilön lisäys</title>
   <meta charset="utf-8">
</head>

<body>

<?php

   $yhteys = db::getDB();
   // Tarkistetaan ensin onko kentät täytetty oikein:
   if (empty($_POST['etu'])) {
   header('Location: lomakesivu.php?viesti=Etunimi%puuttui'); die();
   }
   if (strlen($_POST['etu']) > 30) {
   header('Location: lomakesivu.php?viesti=Etunimi%liian%pitkä'); die();
   }

   if (empty($_POST['suku'])) {
   header('Location: lomakesivu.php?viesti=Sukunimi%puuttui'); die();
   }
   if (strlen($_POST['suku']) > 30) {
   header('Location: lomakesivu.php?viesti=Sukunimi%liian%pitkä'); die();
   }

   if (empty($_POST['sposti'])) {
   header('Location: lomakesivu.php?viesti=Sähköposti%puuttui'); die();
   }
   if (strlen($_POST['sposti']) > 30) {
   header('Location: lomakesivu.php?viesti=Sähköposti%liian%pitkä'); die();
   }

   if (empty($_POST['passu'])) {
   header('Location: lomakesivu.php?viesti=Salasana%puuttui'); die();
   }
   if (strlen($_POST['passu']) > 30) {
   header('Location: lomakesivu.php?viesti=Salasana%liian%pitkä'); die();
   }


// Lisätään tiedot tietokantaan:
   $sql = 'INSERT INTO Henkilo values (?, ?, ?, ?, ?, ?)';
   $laita = $yhteys->prepare($sql);
   $laita->execute(array($_POST['etu'], $_POST['suku'], $_POST['sposti'], $_POST['passu'], $_POST['rooli']));

?>



</body>
