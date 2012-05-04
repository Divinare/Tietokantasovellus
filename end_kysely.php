<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <meta charset="utf-8">
    <title><?php print htmlspecialchars($_SESSION["kknimi"]); ?></title>
</head>

<body>

    <h1>Kiitos vastauksistasi</h1>
    <div class="box">
        <h2>Vastauksesi kurssin <?php print $_SESSION["knimi"]; ?> kurssikyselyyn on tallennettu!</h2>
        <img src="KIITOS.png" width="307" height="284" alt=":)" align="center">
    </div>
    <ul class="navbar">
        <li><a href="luoyv.php">Kyselyn yhteenveto</a>
        <li><a href="index.php">Etusivulle</a>
    </ul>

    <?php
       unset($_SESSION["knimi"]);
       unset($_SESSION["kknimi"]);
    ?>

</body>

