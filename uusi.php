<?php
// Uuden kyselyn luonti
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
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

        // Kyselyn otsikko/nimi
        $sqlo = 'SELECT kknimi FROM Kurssikysely WHERE kurssikyselyID = ?';
        $otsikko = $yhteys->prepare($sqlo);
        $otsikko->execute(array($_GET["kyselyid"]));
        $otsikkov = $otsikko->fetch();

        // Uuden kyselyn jo olemassa olevien kysymysten haku
        $sql1 = 'SELECT kysymys, kysymysID FROM Kysymys WHERE kurssikyselyID = ?';
        $uusi = $yhteys->prepare($sql1);
        $uusi->execute(array($_GET["kyselyid"]));
        $uudet = $uusi->fetchAll();
        ?>

        <h1>Uusi kysely</h1>

        <div class="box">
            <p>Kyselyn nimi: <b><?php print $otsikkov[0]; ?></b></p>

            <?php
            // Otsikon vaihtamisen virhe- tai onnistumisilmoitus ja sen käsittely
            $viesti = $_GET["viestiots"];
            if ($viesti == "OK!") {
                print "OK!";
            } else if ($viesti == "yhyy") {
                print "<font color='red'>Otsikon sallittu pituus 1-50 merkkiä - antamasi pituus oli " . $_GET["p"] . ".</font>";
            }
            ?>            
            <form action="uusi_nimi.php?opettaja=<?php print $_GET['opettaja']; ?>&kyselyid=<?php print $_GET['kyselyid']; ?>&mista=u" method="post">
                <input type="text" name="kknimi" id="kknimi">
                <input type="submit" value = "Muuta nimeä">
            </form>
            <br><br>

            <!-- Kysymystaulu -->

            <?php
            if (sizeof($uudet) > 0) {
                ?>
                <table>
                    <th align="left">Tallennetut kysymykset</th>
                    <th>     </th>
                    <tr>
                        <?php
                        for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
                            ?>

                            <td><?php print $uudet[$i]['kysymys']; ?></td>

                            <!-- Kysymyksen poisto -->
                            <td><a href=kpoisto.php?opettaja=<?php print $_GET["opettaja"]; ?>&&remv=<?php print $uudet[$i]['kysymysid']; ?>&&kyselyid=<?php print $_GET["kyselyid"]; ?>&mista=u>Poista</a>
                        </tr>
                    <?php } ?>
                </table>
                <?php
            } else {
                ?>

                <table>
                    <th align = "left">Tallennetut kysymykset</th>
                    <tr>
                        <td>(tyhjä)</td>
                    </tr>
                </table>

                <?php
            }
            ?>
            <br><br>

            <!-- Uuden kysymyksen lisääminen -->
            <?php
            // Kysymyken lisäämisen virhe- tai onnistumisilmoitus ja sen käsittely
            if ($_GET["viesti"] == "OK!") {
                print "OK!";
            } else if ($_GET["viesti"] == "yhyy") {
                print "<font color='red'>Kysymyksen sallittu pituus 1-300 merkkiä - antamasi pituus oli " . $_GET["p"] . ".</font>";
            }
            ?>

            <FORM action="lisaa_kysymys.php?opettaja=<?php print $_GET['opettaja']; ?>&kyselyid=<?php print $_GET['kyselyid']; ?>&mista=u" method="post">
                <input type="text" name="ukysymys">
                <input type="submit" value="Lisää kysymys">
            </FORM>
            <br><br>

        </div>

        <ul class="navbar">
            <li><p><a href="opettaja.php?opettaja=<?php print $_GET['opettaja']; ?>">Oma sivu</a></p>
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
