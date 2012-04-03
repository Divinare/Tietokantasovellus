<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>"Opettajan Lisäys"</title>
   <meta charset="utf-8">
</head>

   <body>
   <h1>Opettajan Lisäys</h1>
   <?php
   print 'Opettajan etunimi:'."</br>";
   print "<input type='text' name='etu'>"."</br>"."</br>";

   print 'Opettajan sukunimi:'."</br>";
   print "<input type='text' name='suku'>"."</br>"."</br>";

   print 'Opettajan sähköposti:'."</br>";
   print "<input type='text' name='sposti'>"."</br>"."</br>";

   print 'Opettajan salasana:'."</br>";
   print "<input type'text' name='passu'>"."</br>"."</br>";

   print 'Rooli:'."<br>";
   <input type="radio" name="rooli" value="opettaja" checked> Opettaja <br>
   <input type="radio" name="rooli" value="admin"> Admin <br>
   <input type="radio" name="rooli" value="laitoksen vastuuhenkilö"> Laitoksen Vastuuhenkilö <br>

   // lisätään tiedot tietokantaan
   //$yhteys = db::getDB();

   //$sql = 'INSERT INTO Henkilo values (?, ?, ?, ?, ?, ?)';
   //$laita = $yhteys->prepare($sql);
   //$laita->execute(array($henkiloid, $etu, $suku, $sposti, $passu, $rooli));
   //$nimi = $laita->fetch();




   ?>
   <body>
