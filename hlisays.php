<?php
// Tekee lomakkeen henkilön lisäystä varten
require_once 'DB.php';
session_start();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Henkilön Lisäys</title>
    <meta charset="utf-8">
</head>

<body>

    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["hlisays"]) {
        ?>

        <h1>Henkilön Lisäys</h1>
        <div class="box">
            <Form name ='henkilotiedot' Method ='Post' ACTION ='lisays.php?lisays=<?php print $_GET['hlisays']; ?>'>

                <p>Etunimi:</p>
                <input type='text' name='etu' value='<?php print $_GET["etu"] ?>'>
                <?php
                if ($_GET["viesti"] == "etupuuttui") {
                    print "<font color='red'>Et antanut etunimeä.</font>";
                }
                if ($_GET["viesti"] == "etupitkä") {
                    print "<font color='red'>Etunimi liian pitkä - sallittu pituus 1-30 merkkiä.</font>";
                }
                ?>

                <p>Sukunimi:</p>
                <input type='text' name='suku' value='<?php print $_GET["suku"] ?>'>
                <?php
                if ($_GET["viesti"] == "sukupuuttui") {
                    print "<font color='red'>Et antanut sukunimeä.</font>";
                }
                if ($_GET["viesti"] == "sukupitkä") {
                    print "<font color='red'>Sukunimi liian pitkä - sallittu pituus 1-30 merkkiä.</font>";
                }
                ?>

                <p>Sähköposti:</p>
                <input type='text' name='sposti' value='<?php print $_GET["sähkö"] ?>'>
                <?php
                if ($_GET["viesti"] == "emailpuuttui") {
                    print "<font color='red'>Et antanut sähköpostia.</font>";
                }
                if ($_GET["viesti"] == "emailpitkä") {
                    print "<font color='red'>Sähköposti oli liian pitkä - sallittu pituus 1-80 merkkiä.</font>";
                }
                if ($_GET["viesti"] == "emailkäytössä") {
                    print "<font color='red'>Sähköposti on jo käytössä.</font>";
                }
                ?>

                <p>Salasana:</p>
                <input type='password' name='passu'>
                <?php
                if ($_GET["viesti"] == "salapuuttui") {
                    print "<font color='red'>Et antanut salasanaa.</font>";
                }
                if ($_GET["viesti"] == "salapitkä") {
                    print "<font color='red'>Salasana liian pitkä - sallittu pituus 1-15 merkkiä.</font>";
                }
                if ($_GET["viesti"] == "salateitäsmää") {
                    print "<font color='red'>Salasanat eivät täsmänneet.</font>";
                }
                if ($_GET["viesti"] == "salalyhyt") {
                    print "<font color='red'>Salasanan oltava vähintään 8 merkkinen.</font>";
                }
                ?>

                <p>Vahvista salasana:</p>
                <input type='password' name='passu2'>

                <p>Rooli:</p>
                <input type="radio" name="rooli" value="opettaja" checked> Opettaja </br>
                <input type="radio" name="rooli" value="admin"> Admin </br>
                <input type="radio" name="rooli" value="vastuuhenkilö"> Laitoksen vastuuhenkilö </br>

                <Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>
            </form>
        </div>
        <ul class="navbar">
            <li><p><a href=admin.php?admin=<?php print $_GET['hlisays']; ?>>Oma sivu</a></p></li>
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
