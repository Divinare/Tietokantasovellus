<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Vahvistus</title>
   <meta charset="utf-8">
</head>

<body>

   <h3>Henkilön lisäys onnistui!</h3>

   <Form name='form1' Method='Post' action='checklogin.php'>
   <Input type = 'Submit' Name = 'submit' Value = 'Takaisin'>

   <?php

   $yhteys = db::getDB();

   $sql = 'INSERT INTO Henkilo values (?, ?, ?, ?, ?)';
   $laita = $yhteys->prepare($sql);
   $laita->execute(array($_POST['etu'], $_POST['suku'], $_POST['sposti'], $_POST['passu'], $_POST['rooli']));

   ?>
