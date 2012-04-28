<?php
    require_once 'DB.php';
    session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
   <title>Salasanan vaihto</title>
   <meta charset="utf-8">
</head>
<body>

     <?php

          $yhteys = db::getDB();

          // Istuntotarkastus
          if ($_SESSION["ihminen"] == $_GET["vaihdasala"]) {

             $sql = 'SELECT etunimi, sukunimi, rooli FROM henkilo WHERE henkiloid = ?';
             $admin = $yhteys->prepare($sql);
             $admin->execute(array($_GET['vaihdasala']));
             $nimi = $admin->fetch();
             echo "<h1>$nimi[2] - $nimi[0] $nimi[1]</h1>";
     ?>

     <Form name ='salasanat' Method ='Post' ACTION ='svaihto.php?svaihto=<?php print $_GET['vaihdasala']; ?>'>

     <p>Vanha salasana:</p>
     <input type='password' name='vanha'>
     <?php
     if ($_GET["viesti"] == vanhavaara) {
         print "<font color='red'>Vanha salasana ei täsmännyt.<font color='black'>";
	 }
     ?>
     <p>Uusi salasana:</p>
     <input type='password' name='uusi'>
     <?php
     if ($_GET["viesti"] == salalyhyt) {
        print "<font color='red'>Salasanan oltava vähintään 8 merkkiä.<font color='black'>";
     }
     if ($_GET["viesti"] == salapitkä) {
        print "<font color='red'>Salasanan oltava enintään 15 merkkiä.<font color='black'>";
     }
     if ($_GET["viesti"] == salateitäsmää) {
        print "<font color='red'>Salasanat eivät täsmänneet.<font color='black'>";
     }
     ?>
     <p>Vahvista salasana:</p>
     <input type='password' name='uusi2'><br><br>

     <Input type = 'Submit' Name = 'submit' Value = 'Vaihda salasanaa'>
     </form>
     <?php
          $sql = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
          $kyselyrooli = $yhteys->prepare($sql);
          $kyselyrooli->execute(array($_GET["vaihdasala"]));
          $rooli = $kyselyrooli->fetch();
     ?>

     <p> <a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET['vaihdasala']; ?>><img src="nuoli.png" border="0" /></a></p>

     <?php

          }
          // Istuntotarkastus failaa
          else {
             header("Location: access_denied.php"); die();
          }
     ?>
</body>
