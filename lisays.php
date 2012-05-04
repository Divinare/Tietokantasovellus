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
    if ($_SESSION["ihminen"] == $_GET["lisays"]) {

        // Koetetaan hakea sähköposti tietokannasta (kahta samaa sähköpostia ei saa olla)
        $sql = "SELECT email FROM henkilo WHERE email = ?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($_POST['sposti']));
        $taulu = $kysely->fetch();

        // Tarkastetaan onko kentät täytetty oikein
        if (empty($_POST['etu'])) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=etupuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if (strlen($_POST['etu']) > 30) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=etupitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }

        if (empty($_POST['suku'])) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=sukupuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }

        if (strlen($_POST['suku']) > 30) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=sukupitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }

        if (empty($_POST['sposti'])) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=emailpuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if (strlen($_POST['sposti']) > 30) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=emailpitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if (strlen($taulu[0][0] > 0)) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=emailkäytössä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if (empty($_POST['passu'])) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salapuuttui" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if (strlen($_POST['passu']) > 30) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salapitkä" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if (strlen($_POST['passu']) < 8) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salalyhyt" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        if ($_POST['passu'] != $_POST['passu2']) {
            header("Location: hlisays.php?hlisays=" . $_GET["lisays"] . "&viesti=salateitäsmää" . "&etu=" . $_POST['etu'] . "&suku=" . $_POST['suku'] . "&sähkö=" . $_POST['sposti']);
            die();
        }
        ?>

        <!-- Jos kaikki on kunnossa näytetään vielä tiedot, jotka täytyy vahvistaa -->
        <h2>Vahvista alla olevat tiedot</h2>
        <div class="box">
            <table>
                <tr>
                    <td><b>ETUNIMI</b></td>
                    <td><?php print htmlspecialchars($_POST['etu']); ?> </td>
                </tr>
                <tr>
                    <td><b>SUKUNIMI</b></td>
                    <td><?php print htmlspecialchars($_POST['suku']); ?> </td>
                </tr>
                <tr>
                    <td><b>E-MAIL</b></td>
                    <td><?php print htmlspecialchars($_POST['sposti']); ?></td>
                </tr>
                <tr>
                    <!-- Printataan salasanan verran tähtiä -->
                    <td><b>SALASANA</b></td>
                    <td><?php
    for ($i = 1; $i <= strlen($_POST['passu']); $i++) {
        print '*';
    }
        ?> </td>
                </tr>
                <tr>
                    <td><b>ROOLI</b></td>
                    <td><?php print $_POST['rooli']; ?></td>
                </tr>
            </table>
            <br>
            <!-- Nappula, joka lähettää tiedot lomakelahetys.php:lle -->
            <Form name ='tiedot' Method ='Post' ACTION ='lomakelahetys.php?lomakelahetys=<?php print $_GET['lisays']; ?>'>
                <input type='hidden' name='etu' value='<?php print htmlspecialchars($_POST['etu']); ?>'>
                <input type='hidden' name='suku' value='<?php print htmlspecialchars($_POST['suku']); ?>'>
                <input type='hidden' name='sposti' value='<?php print htmlspecialchars($_POST['sposti']); ?>'>
                <input type='hidden' name='passu' value='<?php print htmlspecialchars($_POST['passu']); ?>'>
                <input type='hidden' name='rooli' value='<?php print htmlspecialchars($_POST['rooli']); ?>'>
                <Input type = 'Submit' Name = 'submit' Value = 'Vahvista tiedot'>
            </form>
        </div>
        <ul class="navbar">
            <li><p><a href=admin.php?admin=<?php print $_GET['lisays']; ?>>Oma sivu</a></p></li>
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
