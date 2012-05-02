<?php
// Kurssinlisäyssivu
require_once 'DB.php';
session_start();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title> Uusi kysely </title>
    <meta charset="utf-8">
</head>
<body>

    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["opettaja"]) {
        ?>
        <!-- Kurssinlisäyslomake -->
        <h1>Lisää kurssi </h1>
        <ul class="box">

            <Form name ='uusikurssi' Method ='Post' ACTION ='tarkasta_ktiedot.php?opettaja=<?php print $_GET["opettaja"]; ?>&mista=<?php print $_GET["mista"]; ?>'>

                <p><b>Kurssin nimi: </b></p>
                <input type="text" name="knimi" size="40"></br>

                <p><b>Periodi: </b></p>
                <Input type = 'Radio' Name ='periodi' value= '1' checked>1
                <Input type = 'Radio' Name ='periodi' value= '2'>2
                <Input type = 'Radio' Name ='periodi' value= '3'>3
                <Input type = 'Radio' Name ='periodi' value= '4'>4

                <p><b>Vuosi: </b></p>
                <input type="text" name="vuosi" size="4"></br></br></br>

                <Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>
            </form>
        </ul>
        <?php
        // Virheilmoitukset ja niiden käsittely
        if ($_GET["virhe"] == "n") {
            print "<p><font color='Red'>Antamasi nimen pituus oli virheellinen.</p>";
        } else if ($_GET["virhe"] == "vp") {
            print "<p><font color='Red'>Antamasi vuosiluvun pituus oli virheellinen - sallittu pituus on neljä merkkiä.</p>";
        } else if ($_GET["virhe"] == "vk") {
            print "<p><font color='Red'>Antamasi vuosiluku sisälsi kiellettyjä merkkejä - sallittuja merkkejä ovat numerot 0-9</p>";
        }
        // Istuntotarkastus failaa
    } else {
        header("Location: access_denied.php");
        die();
    }
    ?>
    <ul class="navbar">
        <li><p><a href="opettaja.php?opettaja=<?php print $_GET["opettaja"] ?>">Oma sivu</a></p>
    </ul>
</body>
