<?php
     // Tiedosto lähettää tarkasta_ktiedot.php:lle tiedot uudesta kantaan lisättävästä kurssista  <--- tosin ei tämä vielä lähetä niitä sinne :P
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
           <Form name ='uusikurssi' Method ='Post' ACTION ='luo_kysely.php?opettaja=<?php print $_GET["opettaja"]; ?>'>

               <h1>Lisää kurssi </h1>

               <p><b>Kurssin nimi: </b></p>
               <input type="text" name="knimi" size="50"></br>

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
         }
         else {
            header("Location: access_denied.php"); die();
         }
    ?>
</body>
