<!DOCTYPE html>
<html>
  <head>
    <title>Aapelin vieraskirja</title>
  </head>
  <body>
  <h1>Aapelin vieraskirja</h1>
  <p><a href="uusiviesti.html">Lähetä uusi viesti</a></p>
<?php
include("yhteys.php");

$sql = "SELECT kirjoittaja, aika, sisalto
        FROM viestit
        ORDER BY aika DESC";

$kysely = $yhteys->prepare($sql);
$kysely->execute();

while ($rivi = $kysely->fetch()) {
    $kirjoittaja = htmlspecialchars($rivi["kirjoittaja"]);
    $aika = $rivi["aika"];
    $sisalto = htmlspecialchars($rivi["sisalto"]);
    $sisalto = nl2br($sisalto);
    echo "<hr>";
    echo "<p><b>Kirjoittaja:</b> {$kirjoittaja}</p>";
    echo "<p><b>Aika:</b> {$aika}</p>";
    echo "<p><b>Viesti:</b> <br> {$sisalto}</p>";
}
?>
  </body>
</html>
