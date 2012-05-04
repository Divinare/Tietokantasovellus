<?php
// Tulostetaan valittuun kysymykseen liittyvät kommentit
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Kommentit</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["henkiloid"]) {

        // Haetaan kysymys ja kaikki siihen liittyvät kommentit
        $sql = "SELECT kysymys FROM Kysymys WHERE kysymysID = ?";
        $op = $yhteys->prepare($sql);
        $op->execute(array($_GET["kysymysid"]));
        $nimi = $op->fetch();

        $sql = "SELECT kommentti FROM Kommentti WHERE kysymysID = ?";
        $sqlk = $yhteys->prepare($sql);
        $sqlk->execute(array($_GET["kysymysid"]));
        $tulos = $sqlk->fetchAll();
        ?>

        <h1><b><?php print $nimi["kysymys"]; ?></b> -kysymyksen kommentit</h1>
        <div class="box">
            <?php
            for ($i = 0; $i < sizeof($tulos); $i++) {
                print "<p>" . $tulos[$i]["kommentti"] . "</p><br>";
            }
            ?>
        </div>
        <ul class="navbar">
            <li><p><a href=luoyv.php?luoyv=<?php print $_GET['kurssikyselyid']; ?>&henkiloid=<?php print $_GET['henkiloid']; ?>>Takaisin</a></p></li>
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
