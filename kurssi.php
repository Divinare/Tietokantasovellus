<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title> Uusi kysely </title>
   <meta charset="utf-8">
</head>
<body>

   <?php
       $yhteys = db::getDB();
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
</body>
