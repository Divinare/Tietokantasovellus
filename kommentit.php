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

    $sqlx = 'SELECT kysymys FROM Kysymys WHERE kysymysid = ?';
    $sqly = $yhteys->prepare($sqlx);
    $sqly->execute(array($_GET["kysymysid"]));
    $sqlz = $sqly->fetch();

    print "<br><font size='4'><b>Kysymyksen ".$sqlz[0]. " kommentit:</b></font><br><br><br>";

    $sql = 'SELECT kommentti FROM Kommentti WHERE kysymysid = ?';
    $sqlk = $yhteys->prepare($sql);
    $sqlk->execute(array($_GET["kysymysid"]));
    $sqlk2 = $sqlk->fetchAll();

    for ($i = 0; $i < sizeof($sqlk2); $i++) {
    print $sqlk2[$i][0]."<br><br><br>";
    }
    ?>
    <p><a href=luoyv.php?luoyv=<?php print $_GET['kurssikyselyid']; ?>&henkiloid=<?php print $_GET['henkiloid']; ?>><img src="nuoli.png" border="0" /></a></p>
    <?php
    } else {
       header("Location: access_denied.php");
       die();
    }
    ?>
</body>
