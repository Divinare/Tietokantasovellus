<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Vahvistus</title>
   <meta charset="utf-8">
</head>

<body>

   <h3>Henkilön lisäys onnistui!</h3>

   <p><a href=admin.php?admin=<?php print $_GET['lomakelahetys']; ?>>Takaisin</a></p>

   <?php

   $yhteys = db::getDB();

   $sql = 'INSERT INTO Henkilo values (?, ?, ?, ?, ?)';
   $laita = $yhteys->prepare($sql);
   $laita->execute(array($_POST['etu'], $_POST['suku'], $_POST['sposti'], $_POST['passu'], $_POST['rooli']));
   ?>
