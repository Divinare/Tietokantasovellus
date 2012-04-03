<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>"Opettajan Lisäys"</title>
   <meta charset="utf-8">
</head>

   <body>
   <h1>Opettajan Lisäys</h1>

   <Form name ='vastaukset' Method ='Post' ACTION ='lisays.php?lisays=".$_GET["kysely"]."'>

   <p>Opettajan etunimi:</p>
   <input type='text' name='etu'><p></br>

   <p>Opettajan sukunimi:</p>
   <input type='text' name='suku'></br></br>

   <p>Opettajan sähköposti:</p>
    <input type='text' name='sposti'></br></br>

   <p>Opettajan salasana:</p>
   <input type'text' name='passu'></br></br>

   <p>Rooli:<p>
   <input type="radio" name="rooli" value="opettaja" checked> Opettaja </br>
   <input type="radio" name="rooli" value="admin"> Admin </br>
   <input type="radio" name="rooli" value="laitoksen vastuuhenkilö"> Laitoksen Vastuuhenkilö </br>

   <?php
   // lisätään tiedot tietokantaan
   //$yhteys = db::getDB();
   //$sql = 'INSERT INTO Henkilo values (?, ?, ?, ?, ?, ?)';
   //$laita = $yhteys->prepare($sql);
   //$laita->execute(array($henkiloid, $etu, $suku, $sposti, $passu, $rooli));
   //$nimi = $laita->fetch();

   if (isset($etu)) {
   echo "Et antanut etunimeä";
   }
   //if (strlen($etu) > 30) {
   //echo "Annoit liian pitkän etunimen";
   //}
   //else {
   //<Input type = 'Submit' Name = 'submit' Value = 'Lisää henkilö'>
   // }
//16:57 <Purrrrrr> Sä voit tehä actioniks välisivun jossa on koodia tyyliin <?php if (empty($_POST['etu'])) { 
//                 header('Location: lomakesivu.php?viesti=Etunimi%20puuttui'); die(); }
//17:00 <Purrrrrr> Jos sen tekee tohon tyyliin, mitä ylhääl, niin se tulee muuttujaan $_GET['viesti']

?>
   </form>



   <body>
