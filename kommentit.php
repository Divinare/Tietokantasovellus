<?php
require_once 'DB.php';
session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<head>
   <title>Käyttäjän muokkaus</title>
   <meta charset="utf-8">
</head>
<body>

    <?php
    $yhteys = db::getDB();

    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["henkiloid"]) {

    print "Kysymyksen x kommentit<br><br><br>";

    $sql = 'SELECT kommentti FROM Kommentti WHERE kysymysid = ?';
    $sqlk = $yhteys->prepare($sql);
    $sqlk->execute(array($_GET["kysymysid"]));
    $sqlk2 = $sqlk->fetchAll();

    for ($i = 0; $i < sizeof($sqlk2); $i++) {
    print $sqlk2[$i][0]."<br><br>";
    }


   } else {
       header("Location: access_denied.php");
       die();
   }
   ?>
</body>
