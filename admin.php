<?php
// Adminin etusivu
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Admin</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["admin"]) {

        // Haetaan adminin henkilötiedot otsikkoa varten
        $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
        $kyselyadmin = $yhteys->prepare($sql);
        $kyselyadmin->execute(array($_GET["admin"]));
        $nimi = $kyselyadmin->fetch();
        $etu = $nimi[0];
        $suku = $nimi[1];
        ?>

        <h1>Admin - <?php print htmlspecialchars($etu) . " " . htmlspecialchars($suku); ?></h1>

        <div class="box">
           <br><br><br><br><br><br><br><br><br><br>
        </div>

        <!-- Navigointipalkki -->
        <ul class="navbar">

            <li><p><a href=hlisays.php?hlisays=<?php print $_GET["admin"]; ?>>Henkilön lisäys järjestelmään</a></p></li>

            <li><p><a href=hlista.php?hlista=<?php print $_GET["admin"]; ?>>Käyttäjälistat</a></p></li>

            <li><p><a href=vaihdasala.php?vaihdasala=<?php print $_GET["admin"]; ?>>Salasanan vaihto</a></p></li>

            <li><p><a href=index.php>Kirjaudu ulos</a></p></li>

        </ul>
        <?php
    // Istuntotarkastus failaa
    } else {
        header("Location: access_denied.php");
        die();
    }
    ?>
</body>
