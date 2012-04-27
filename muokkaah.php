<?php
require_once 'DB.php';
session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<head>
<title>Kyselyn muokkaus</title>
<meta charset="utf-8">
</head>
<body>

<?php
    $yhteys = db::getDB();

    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["admin"]) {

    // Haetaan henkilötiedot:
    $sqltiedot = 'SELECT etunimi, sukunimi, email, rooli FROM henkilo WHERE henkiloid = ?';
    $sqlt2 = $yhteys->prepare($sqltiedot);
    $sqlt2->execute(array($_GET["henkiloid"]));
    $sqlt = $sqlt2->fetchAll();

    //echo $sqlt[0][1];
   ?>
    <h2>Käyttäjätietojen muokkaus - <?php print $sqlt[0][0]." ".$sqlt[0][1];?></h2>

    <table border="0" cellpadding="1">
       <tr>
         <th </th>
         <th </th>
         <th </th>
       </tr>
       <tr>
          <td><p>Etunimi:</p></td>
          <td><p><b><?php print $sqlt[0][0]; ?></b></p></td>
          <td><form action="muutah.php?muutah=<?php print $_GET['admin']; ?>&henkiloid=<?php print $_GET['henkiloid']; ?>&viesti=etunimi" method="post">
                <input type="text" name="etu">
                <input type="submit" value = "Muuta">
                <?php
                if ($_GET["viesti"] == etufail) {
                 print "<font color='red'>Etunimen on oltava 1-30 merkkiä pitkä.<font color='black'>";
                 }
                 ?>
         </form>
	 </td>
       </tr>
       <tr>
          <td><p>Sukunimi:</p></td>
          <td><p><b><?php print $sqlt[0][1]; ?></b></p></td>
          <td><form action="muutah.php?muutah=<?php print $_GET['admin']; ?>&viesti=sukunimi" method="post">
                <input type="text" name="suku">
                <input type="submit" value = "Muuta">
                <?php
                if ($_GET["viesti"] == sukufail) {
                 print "<font color='red'>Sukunimen on oltava 1-30 merkkiä pitkä.<font color='black'>";
                 }
                 ?>

         </form>
         </td>
       </tr>
       <tr>
          <td><p>Sähköposti:</p></td>
          <td><p><b><?php print $sqlt[0][2]; ?></b></p></td>
          <td><form action="muutah.php?muutah=<?php print $_GET['admin']; ?>&viesti=sähköposti" method="post">
                <input type="text" name="sähkö">
                <input type="submit" value = "Muuta">
         </form>
         </td>
       </tr>
       <tr>
          <td><p>Rooli:</p></td>
          <td><p><b><?php print $sqlt[0][3]; ?></b></p></td>
          <td><form action="muutah.php?muutah=<?php print $_GET['admin']; ?>&viesti=rooli" method="post">
                <input type="text" name="rooli">
                <input type="submit" value = "Muuta">
         </form>
         </td>
       </tr>
    </table>

     <p> <a href=admin.php?admin=<?php print $_GET["admin"]; ?>><img src="nuoli.png" border="0" /></a></p>

   <?php
   } else {
       header("Location: access_denied.php");
       die();
   }
   ?>
</body>
