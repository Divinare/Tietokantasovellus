<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />

<!-- Tämä on etusivu, jolla listataan avoimet kurssikyselyt ja jolla on sisäänkirjautuminen -->
<head>
    <title> Kurssikysely </title>
    <meta charset="utf-8">
</head>

<h1>Käynnissä olevat kurssikyselyt</h1>

<?php
$yhteys = db::getDB();

// Haetaan avointen kyselyjen nimet tiedot
$kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';

print "<ul class='box'>";

foreach ($yhteys->query($kysely) as $tulos) {
    print "<a href=kysely.php?kysely=" . $tulos['kurssikyselyid'] . " class ='kysely'>" . $tulos['kknimi'] . "</a>" . "</br>";
}
?>
</ul>

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
</ul>


</br></br></br></br>
<?php
if ($_GET["m"] == "kurjuus") {
    print "<font color='red'><p>Antamasi käyttäjätunnus ja salasana eivät täsmää.</p>";
}
?>
</body>

