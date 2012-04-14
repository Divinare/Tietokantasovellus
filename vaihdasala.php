<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<head>
   <title>Admin - Greippikysely</title>
   <meta charset="utf-8">
</head>
       <body>
          <?php
          $yhteys = db::getDB();
          $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid =?';
          $admin = $yhteys->prepare($sql);
          $admin->execute(array($_GET['vaihdasala']));
	  $nimi = $admin->fetch();
          echo "<h1>Admin - $nimi[0] $nimi[1]</h1>";
	  ?>
          <Form name ='salasanat' Method ='Post' ACTION ='svaihto.php?svaihto=<?php print $_GET['vaihdasala']; ?>'>

          <p>Vanha salasana:</p>
          <input type='text' name='vanha'><p></br>

          <p>Uusi salasana:</p>
          <input type='text' name='uusi'></br></br>

          <p>Vahvista salasana:</p>
          <input type='text' name='uusi2'></br></br>

          <Input type = 'Submit' Name = 'submit' Value = 'Vaihda salasanaa'>
          </form>
       </body>
