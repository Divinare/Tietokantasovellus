<?php
// Vaihtaa henkilön salasanan
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
    if ($_SESSION["ihminen"] == $_GET["vaihdasala"]) {

        // Haetaan henkilön tiedot
        $sql = 'SELECT etunimi, sukunimi, rooli FROM henkilo WHERE henkiloid = ?';
        $admin = $yhteys->prepare($sql);
        $admin->execute(array($_GET['vaihdasala']));
        $nimi = $admin->fetch();

        // Tallennetaan henkilön rooli (alkamaan isolla kirjaimella) muuttujaan $rooli
        if ($nimi[2] == "opettaja") {
            $rooli = "Opettaja";
        } else if ($nimi[2] == "admin") {
            $rooli = "Admin";
        } else {
            $rooli = "Vastuuhenkilö";
        }
        print "<h1>$rooli - $nimi[0] $nimi[1]</h1>";
        ?>
        <div class="box">
            <Form name ='salasanat' Method ='Post' ACTION ='svaihto.php?svaihto=<?php print $_GET['vaihdasala']; ?>'>

                <p>Vanha salasana:</p>
                <input type='password' name='vanha'>
    <?php
    if ($_GET["viesti"] == vanhavaara) {
        print "<font color='red'>Vanha salasana ei täsmännyt.<font color='black'>";
    }
    ?>
                <p>Uusi salasana:</p>
                <input type='password' name='uusi'>
    <?php
    // Ilmoitetaan jos salasana on vääränlainen
    if ($_GET["viesti"] == salalyhyt) {
        print "<font color='red'>Salasanan oltava vähintään 8 merkkiä.<font color='black'>";
    }
    if ($_GET["viesti"] == salapitkä) {
        print "<font color='red'>Salasanan oltava enintään 15 merkkiä.<font color='black'>";
    }
    if ($_GET["viesti"] == salateitäsmää) {
        print "<font color='red'>Salasanat eivät täsmänneet.<font color='black'>";
    }
    ?>
                <p>Vahvista salasana:</p>
                <input type='password' name='uusi2'><br><br>

                <Input type = 'Submit' Name = 'submit' Value = 'Vaihda salasanaa'>
            </form>
        </div>
        <!-- Linkki takaisin omalle sivulle -->
        <ul class="navbar">
            <li><p><a href=<?php print $nimi[2]; ?>.php?<?php print $nimi[2]; ?>=<?php print $_GET['vaihdasala']; ?>>Oma sivu</a></p></li>
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
