<?php
// Ilmoitetaan salasanan vaihdon onnistumisesta ja vaihetaan salasanaa
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>

<head>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<title>Salasanan vaihto</title>
<meta charset="utf-8">
</head>

<body>

<?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["svaihto"]) {

        // Uuden salasanan kryptaaminen
        $salasana = $_POST["uusi"];
        $tiiviste = md5(md5($salasana . "greippejäomnomnom") . "lisääsitruksia");

        // Salasanan päivittäminen kantaan
        $sqlsala = 'UPDATE Henkilo SET salasana = ? WHERE henkiloID = ?';
        $sqlsala2 = $yhteys->prepare($sqlsala);
        $sqlsala2->execute(array($tiiviste, $_GET["svaihto"]));

        // Roolin hakeminen takaisin-linkkiä varten
        $sql = 'SELECT rooli FROM henkilo WHERE henkiloid = ?';
        $kyselyrooli = $yhteys->prepare($sql);
        $kyselyrooli->execute(array($_GET["svaihto"]));
        $rooli = $kyselyrooli->fetch();
        ?>
        <h1>Salasanan vaihto</h1>
        <div class="box">

            <p>Onnistui!</p>

        </div>
        <ul class="navbar">
            <li><p> <a href=<?php print $rooli[0]; ?>.php?<?php print $rooli[0]; ?>=<?php print $_GET["svaihto"]; ?>>Oma si$
            <li><p><a href=index.php>Kirjaudu ulos</a></p></li>
        </ul>
    <?php
}
// Istuntotarkastus failaa
else {
    header("Location: access_denied.php");
    die();
}
?>

</body>

