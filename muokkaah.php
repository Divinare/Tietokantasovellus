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




   ?>

    <p> <a href=admin.php?admin=<?php print $_GET["muokkaah"]; ?>>Takaisin</a></p>



   <?php
   } else {
       header("Location: access_denied.php");
       die();
   }
   ?>
</body>
