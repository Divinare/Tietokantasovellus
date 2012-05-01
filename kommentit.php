<?php
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<head>
   <link rel="stylesheet" type="text/css" href="tyylit.css" />
   <title>Käyttäjän muokkaus</title>
   <meta charset="utf-8">
</head>
<body>
    <?php

    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["henkiloid"]) {

    $sqlx = 'SELECT kysymys FROM Kysymys WHERE kysymysid = ?';
    $sqly = $yhteys->prepare($sqlx);
    $sqly->execute(array($_GET["kysymysid"]));
    $sqlz = $sqly->fetch();

    print "<h2><b>".$sqlz[0]. "</b> -kysymyksen kommentit</h2>";

    $sql = 'SELECT kommentti FROM Kommentti WHERE kysymysid = ?';
    $sqlk = $yhteys->prepare($sql);
    $sqlk->execute(array($_GET["kysymysid"]));
    $sqlk2 = $sqlk->fetchAll();
?>
<ul class="box">
<?php
    for ($i = 0; $i < sizeof($sqlk2); $i++) {
    print $sqlk2[$i][0]."<br><br><br>";
    }
    ?>
</ul>
<ul class="navbar">
    <li><p><a href=luoyv.php?luoyv=<?php print $_GET['kurssikyselyid']; ?>&henkiloid=<?php print $_GET['henkiloid']; ?>>Takaisin</a></p>
</ul>
    <?php
      // Istuntotarkastus failaa
    } else {
       header("Location: access_denied.php");
       die();
    }
    ?>

</body>
