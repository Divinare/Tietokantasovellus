<?php
// Henkilön lisäys
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Vahvistus</title>
    <meta charset="utf-8">
</head>

<body>
    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["admin"]) {
        ?>
        <!--Näytetään vielä tiedot, jotka täytyy vahvistaa-->
        <h2>Vahvista alla olevat tiedot</h2>
        <div class = "box">
            <table>
                <tr>
                    <td><b>ETUNIMI</b></td>
                    <td><?php print htmlspecialchars($_SESSION["etu"]);
        ?> </td>
                </tr>
                <tr>
                    <td><b>SUKUNIMI</b></td>
                    <td><?php print htmlspecialchars($_SESSION["suku"]); ?> </td>
                </tr>
                <tr>
                    <td><b>E-MAIL</b></td>
                    <td><?php print htmlspecialchars($_SESSION["email"]); ?></td>
                </tr>
                <tr>
                    <!-- Printataan salasanan verran tähtiä -->
                    <td><b>SALASANA</b></td>
                    <td>
                        <?php
                        for ($i = 1; $i <= strlen($_SESSION['pw']); $i++) {
                            print '*';
                        }
                        ?> </td>
                </tr>
                <tr>
                    <td><b>ROOLI</b></td>
                    <td><?php print $_SESSION["rooli"]; ?></td>
                </tr>
            </table>
            <br>

            <!-- Nappula, joka lähettää tiedot lomakelahetys.php:lle -->
            <Form name ='tiedot' Method ='Post' ACTION ='lomakelahetys.php?lomakelahetys=<?php print $_GET['admin']; ?>'>
                <input type='hidden' name='etu' value='<?php print htmlspecialchars($_SESSION["etu"]); ?>'>
                <input type='hidden' name='suku' value='<?php print htmlspecialchars($_SESSION["suku"]); ?>'>
                <input type='hidden' name='sposti' value='<?php print htmlspecialchars($_SESSION["email"]); ?>'>
                <input type='hidden' name='passu' value='<?php print htmlspecialchars($_SESSION["pw"]); ?>'>
                <input type='hidden' name='rooli' value='<?php print htmlspecialchars($_SESSION["rooli"]); ?>'>
                <Input type = 'Submit' Name = 'submit' Value = 'Vahvista tiedot'>
            </form>
        </div>

        <?php
            unset($_SESSION["suku"]);
            unset($_SESSION["email"]);
            unset($_SESSION["pw"]);
            unset($_SESSION["rooli"]);
        ?>
        <ul class="navbar">
	    <li><p><a href=hlisays.php?hlisays=<?php print $_GET['admin']; ?>>Takaisin</a></p></li>
            <li><p><a href=admin.php?admin=<?php print $_GET['admin']; ?>>Oma sivu</a></p></li>
            <li><p><a href=index.php>Kirjaudu ulos</a></p></li>
        </ul>
    </body>
    <?php
// Istuntotarkistus failaa
} else {
    header("Location: access_denied.php");
    die();
}
?>
