<?php
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>

<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<title>Henkilö poistettiin</title>
<meta charset="utf-8">
</head>
<body>

<?php

    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["admin"]) {

       // Haetaan vielä henkilön nimi
       $sqltiedot = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
       $sqlt2 = $yhteys->prepare($sqltiedot);
       $sqlt2->execute(array($_GET["henkiloid"]));
       $sqlt = $sqlt2->fetchAll();
?>
       <h1>Henkilön poisto</h1>
       <ul class="box">

       <h2>Henkilö <?php print $sqlt[0][0]." ".$sqlt[0][1]; ?> poistettu onnistuneesti!</h2>
       </ul>
<ul class="navbar">
<li><p><a href=admin.php?admin=<?php print $_GET["admin"]; ?>>Oma sivu</a></p>
</ul>
       <?php
       $sqldelk = 'DELETE FROM kurssi WHERE henkiloid = ?';
       $sqldelk2 = $yhteys->prepare($sqldelk);
       $sqldelk2->execute(array($_GET["henkiloid"]));

       $sqldel = 'DELETE FROM henkilo WHERE henkiloid = ?';
       $sqldel2 = $yhteys->prepare($sqldel);
       $sqldel2->execute(array($_GET["henkiloid"]));

   } else {
       header("Location: access_denied.php");
       die();
   }
   ?>
</body>
