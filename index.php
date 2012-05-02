<?php
// Kyselysivuston julkinen etusivu
require_once 'DB.php';
session_start();
$yhteys = db::getDB();

// Jos jokin istunto on voimassa, se poistetaan
if (isset($_SESSION["ihminen"])) {
    unset($_SESSION["ihminen"]);
}
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title> Kurssikysely </title>
    <meta charset="utf-8">
</head>

<h1>Käynnissä olevat kurssikyselyt</h1>

<div class='box'>
    <?php
// Haetaan avointen kyselyjen nimet tiedot
    $kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';
    ?>
    <table border="0" cellpadding="3">
        <tr>
            <th> </th>
            <th> </th>
        </tr>
        <tr>
            <?php
            // Tulostetaan kyselyt ja niiden valintanapit
            foreach ($yhteys->query($kysely) as $tulos) {
                ?>
                <td><form action="kysely.php" method="post">
                        <input type="hidden" name="kyselyid" value="<?php print $tulos['kurssikyselyid']; ?>">
                        <?php print $tulos['kknimi']; ?></td>
                        <td><input type="submit" value="Valitse">
                    </form></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<!-- Kirjautumiskentät -->
<ul class = "navbar">
    <form name="form1" method="post" action="checklogin.php">
        <fieldset>
            <legend>Kirjaudu sisään</legend>
            <p><label for="name">E-mail:</label><br>
                <input name="email" type="text" id="email"></p>
            <p><label for="e-mail">Salasana:</label><br>
                <input name="salasana" type="password" id="salasana"><br /></p>
            <p class="submit"><input type="submit" name="Submit" value="Kirjaudu"></p>
        </fieldset>
    </form>
    <br>
    <?php
    if ($_GET["m"] == "kurjuus") {
        print "<font color='red' size='2'><p> Antamasi käyttäjätunnus ja salasana eivät täsmää.</font></p>";
    }
    ?>
</ul>
</body>
