<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Yhteenveto - Greippikysely</title>
   <meta charset="utf-8">
</head>

<body>
     <?php
        $yhteys = db::getDB();
        $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid = ?';
        $kyselynimi = $yhteys->prepare($sql);
        $kyselynimi->execute(array($_GET["luoyv"]));
        $knimi = $kyselynimi->fetch();
	echo "<h2>".$knimi['kknimi']."</h2>";

        // Haetaan kaikki kysymykset taulukkoon $kysymykset
        $sqlk = 'SELECT kysymys FROM kysymys WHERE kurssikyselyID = ?';
        $sqlk2 = $yhteys->prepare($sqlk);
        $sqlk2->execute(array($_GET["luoyv"]));
        $kysymykset = $sqlk2->fetch();

        $

     ?>





</body>
