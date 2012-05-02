<?php
// Henkilönpoistosivu
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

        // Haetaan henkilön nimi
        $sqltiedot = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
        $sqlt2 = $yhteys->prepare($sqltiedot);
        $sqlt2->execute(array($_GET["henkiloid"]));
        $sqlt = $sqlt2->fetchAll();

        // Poistetaan henkilö
        $sqldel = 'DELETE FROM henkilo WHERE henkiloid = ?';
        $sqldel2 = $yhteys->prepare($sqldel);
        $sqldel2->execute(array($_GET["henkiloid"]));
                
        ?>
        <h1>Henkilön poisto</h1>
        <div class="box">

            <h2>Henkilö <?php print $sqlt[0][0] . " " . $sqlt[0][1]; ?> poistettu onnistuneesti!</h2>
            
        </div>
        <ul class="navbar">
            <li><p><a href=admin.php?admin=<?php print $_GET["admin"]; ?>>Oma sivu</a></p></li>
        </ul>
        <?php

    } else {
        header("Location: access_denied.php");
        die();
    }
    ?>
</body>



