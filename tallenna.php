<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       // Tallennettavien kysymysten hakeminen
       $yhteys = db::getDB();
       $sql = 'SELECT uusikysymys FROM Temp WHERE opeID = ?';
       $save = $yhteys->prepare($sql);
       $save->execute(array($_GET["opettaja"]));
       $savet = $save->fetchAll();

       // Tallentaminen
       $sql1 = 'INSERT INTO Kysymys VALUES (?)';

   ?>
