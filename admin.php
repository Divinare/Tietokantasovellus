<?php
    require_once 'DB.php';
    session_start();
?>
<!DOCTYPE html>
<head>
   <title>Admin - Greippikysely</title>
   <meta charset="utf-8">
</head>
<body>
  <?php

   if ($_SESSION["ihminen"] == $_GET["admin"]) {
       $yhteys = db::getDB();
       $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
       $kyselyadmin = $yhteys->prepare($sql);
       $kyselyadmin->execute(array($_GET["admin"]));
       $nimi = $kyselyadmin->fetch();
       $etu = $nimi[0];
       $suku = $nimi[1];
       ?>

       <h1>Admin - <?php print $etu." ".$suku;?></h1>
          <p> <a href=hlisays.php?hlisays=<?php print $_GET["admin"]; ?>>Henkilön lisäys järjestelmään</a></p>
          <p> <a href=hlista.php?hlista=<?php print $_GET["admin"]; ?>>Käyttäjälistat</a></p>
          <p> <a href=vaihdasala.php?vaihdasala=<?php print $_GET["admin"]; ?>>Salasanan vaihto</a></p>

  <?php

   }
    else {
      header("Location: access_denied.php"); die();
    }
  ?>
</body>
