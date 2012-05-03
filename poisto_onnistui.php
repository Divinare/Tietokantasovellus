<?php
// Henkilönpoiston onnistumisilmoitussivu
require_once 'DB.php';
session_start();
?>

<!DOCTYPE html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "tyylit.css" />
    <title>Henkilö poistettiin</title>
    <meta charset = "utf-8">
</head>
<?php
// Istuntotarkastus
if ($_SESSION["ihminen"] == $_GET["admin"]) {
    ?>
    <body>

        <h1>Henkilön poisto</h1>
        <div class = "box">

            <p>Henkilö <b><?php print $_SESSION["pnimi"]; ?></b> poistettu onnistuneesti!</p>

        </div>

        <ul class="navbar">
            <li><p><a href=admin.php?admin=<?php print $_GET["admin"]; ?>>Oma sivu</a></p></li>
        </ul>

        <?php
        unset($_SESSION["pnimi"]);
    }
// Istuntotarkastus failaa
    else {
        header("Location: access_denied.php");
        die();
    }
    ?>
</body>

