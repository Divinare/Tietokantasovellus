<?php
     // Tiedosto lähettää tarkasta_ktiedot.php:lle tiedot uudesta kantaan lisättävästä kurssista
     require_once 'DB.php';
     session_start();
     $yhteys = db::getDB();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
        if ($_SESSION["ihminen"] == $_GET["opettaja"]) {
   ?>
           <Form name ='uusikurssi' Method ='Post' ACTION ='tarkasta_ktiedot.php?opettaja=<?php print $_GET["opettaja"]; ?>'>

               <h1>Lisää kurssi </h1>

               <p><b>Kurssin nimi: </b></p>
               <input type="text" name="knimi" size="40"></br>

               <p><b>Periodi: </b></p>
               <Input type = 'Radio' Name ='periodi' value= '1' checked>1
               <Input type = 'Radio' Name ='periodi' value= '2'>2
               <Input type = 'Radio' Name ='periodi' value= '3'>3
               <Input type = 'Radio' Name ='periodi' value= '4'>4

               <p><b>Vuosi: </b></p>
               <input type="text" name="vuosi" size="4"></br></br></br>

               <Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>
           </form>

    <?php

          if ($_GET["virhe"] == "n") {
                 print "<p><font color='Red'>Antamasi nimen pituus oli virheellinen.</p>";
          }

          else if ($_GET["virhe"] =="vp") {
                print "<p><font color='Red'>Antamasi vuosiluvun pituus oli virheellinen - sallittu pituus on neljä merkkiä.</p>";
          }

          else if ($_GET["virhe"] =="vk") {
                 print "<p><font color='Red'>Antamasi vuosiluku sisälsi kiellettyjä merkkejä - sallittuja merkkejä ovat numerot 0-9</p>";
          }

         }
         else {
            header("Location: access_denied.php"); die();
         }
    ?>
    <p><a href="opettaja.php?opettaja=<?php print $_GET["opettaja"]?>"><img src="nuoli.png" border="0" /></a></p>
</body>
