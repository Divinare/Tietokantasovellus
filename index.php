<?php
   require_once 'DB.php';
   session_start();
   if (isset($_SESSION["ihminen"])) {
       unset($_SESSION["ihminen"]);
   }
 ?>
<!DOCTYPE html>
<!-- Tämä on etusivu, jolla listataan avoimet kurssikyselyt ja jolla on sisäänkirjautuminen -->
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title> Kurssikysely </title>
    <meta charset="utf-8">
</head>

<h1>Käynnissä olevat kurssikyselyt</h1>

<?php
$yhteys = db::getDB();

print "<ul class='box'>";

// Haetaan avointen kyselyjen nimet tiedot
$kysely = 'SELECT kurssikyselyid, kknimi FROM Kurssikysely WHERE esilla = TRUE ORDER BY kknimi';
?>
<table border="0" cellpadding="3">
  <tr>
     <th>      </th>
     <th>      </th>
  </tr>
  <tr>
<?php
foreach ($yhteys->query($kysely) as $tulos) {
?>
    <form action="kysely.php" method="post">
    <input type="hidden" name="kyselyid" value="<?php print $tulos['kurssikyselyid']; ?>">
    <td><?php print $tulos['kknimi']; ?></td>
    <td><input type="submit" value="Valitse"></td>
    </form>
  </tr>
<?php
}
?>
</table>
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

