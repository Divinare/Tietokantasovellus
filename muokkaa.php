<?php
// Kyselynmuokkaussivu opettajille
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Kyselyn muokkaus</title>
    <meta charset="utf-8">
</head>
<body>

    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

        // Kyselyn nimi ja tila
        $sqlo = 'SELECT kknimi, esilla, ollutEsilla FROM Kurssikysely WHERE kurssikyselyID = ?';
        $otsikko = $yhteys->prepare($sqlo);
        $otsikko->execute(array($_GET["kyselyid"]));
        $otsikkov = $otsikko->fetch();

        // Uuden kyselyn jo olemassa olevien kysymysten haku
        $sql1 = 'SELECT kysymys, kysymysID FROM Kysymys WHERE kurssikyselyID = ?';
        $uusi = $yhteys->prepare($sql1);
        $uusi->execute(array($_GET["kyselyid"]));
        $uudet = $uusi->fetchAll();

        // Mihin kurssiin kysely liittyy
        $sqlkurssi = 'SELECT nimi, vuosi, periodi FROM Kurssi INNER JOIN Kurssikysely ON Kurssikysely.kurssiID = Kurssi.kurssiID WHERE kurssikyselyID = ?';
        $kurssinimi = $yhteys->prepare($sqlkurssi);
        $kurssinimi->execute(array($_GET["kyselyid"]));
        $kntulos = $kurssinimi->fetch();
        ?>

        <h2>Kurssin <?php print $kntulos['nimi']; ?> (<?php print $kntulos['periodi']; ?>/<?php print $kntulos['vuosi']; ?>) kurssikysely</h2>
        <div class="box">

            <p>Kyselyn nimi: <b><?php print $otsikkov['kknimi']; ?></b></p>

            <?php
            // Jos kyselyä ei ole kertaakaan julkaistu, sen nimeä ja kysymyksiä voi muokata
            if (!$otsikkov["ollutesilla"]) {

                // Ilmoitukset kyselyn nimen muokkaamisen onnistumisesta
                $viesti = $_GET["viestiots"];
                if ($viesti == "OK!") {
                    print "OK!";
                } else if ($viesti == "yhyy") {
                    print "<font color='red'>Otsikon sallittu pituus 1-50 merkkiä - antamasi pituus oli " . $_GET["p"] . ".</font>";
                }
                ?>
                <!-- Kyselyn nimen muuttaminen -->
                <form action="uusi_nimi.php?opettaja=<?php print $_GET['opettaja']; ?>&kyselyid=<?php print $_GET['kyselyid']; ?>&mista=m" method="post">
                    <input type="text" name="kknimi">
                    <input type="submit" value = "Muuta nimeä">
                </form> </br></br>


                <!-- Kyselyssä olevat kysymykset ja niiden poistolinkit-->
                <?php
                // Jos kyselyssä on jo kysymyksiä, ne tulostetaan.
                if (sizeof($uudet) > 0) {
                    ?>
                    <table>
                        <th align="left">Tallennetut kysymykset</th>
                        <tr>
                            <?php
                            for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
                                ?>

                                <td><?php print $uudet[$i]['kysymys']; ?></td>
                                <td><a href=kpoisto.php?opettaja=<?php print $_GET["opettaja"]; ?>&remv=<?php print $uudet[$i]['kysymysid']; ?>&kyselyid=<?php print $_GET["kyselyid"]; ?>&mista=m>Poista</a>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php
                    // Jos tallennettuja kysymyksiä ei vielä ole, siitä ilmoitetaan.
                } else {
                    ?>
                    <table>
                        <th align="left">Tallennetut kysymykset</th>
                        <tr>
                            <td>(tyhjä)</td>
                        </tr>
                    </table>
                    <?php
                }
                ?>
                <br>


                <?php
                // Ilmoitukset kyselyn kysymysten muokkaamisen onnistumisesta
                if ($_GET["viesti"] == "OK!") {
                    print "OK!";
                } else if ($_GET["viesti"] == "yhyy") {
                    print "<font color='red'>Kysymyksen sallittu pituus 1-300 merkkiä - antamasi pituus oli " . $_GET["p"] . ".</font>";
                }
                ?>
                <!-- Uuden kysymyksen lisääminen -->
                <FORM action="lisaa_kysymys.php?opettaja=<?php print $_GET['opettaja']; ?>&kyselyid=<?php print $_GET['kyselyid']; ?>&mista=m" method="post">
                    <input type="text" name="ukysymys">
                    <input type="submit" value="Lisää kysymys">
                </FORM>
                <br><br>


                <?php
                // Jos kysely on ollut julkinen jossain vaiheessa, sen nimeä ja kysymyksiä ei voi muokata
            } else {
                ?>
                <!-- Kyselyssä olevat kysymykset-->
                <table>
                    <th align="left">Tallennetut kysymykset</th>
                    <tr>
                        <?php
                        for ($i = 0, $size = sizeof($uudet); $i < $size; ++$i) {
                            ?>

                            <td><?php print $uudet[$i]['kysymys']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>

                <?php
            }
            ?>

            <!-- Kyselyn tila (näkyvyys) ja sen muuttaminen-->
            <?php
            if ($otsikkov['esilla']) {
                $tila = "Julkaistu";
                $bo = FALSE;
            } else {
                $tila = "Piilossa";
                $bo = TRUE;
            }
            ?>
            <p><b>Kyselyn tila: </b><?php print $tila; ?></p>
            <FORM action="muuta_tila.php?opettaja=<?php print $_GET['opettaja']; ?>&kyselyid=<?php print $_GET['kyselyid']; ?>" method="post">
                <input type="hidden" name="tila" value="<?php print $bo; ?>">
                <input type="submit" value="Muuta"><font color="Red">
            </FORM>
            <p><font color="Red" font size="2"> Huomaathan, että kyselyä ei voi muokata sen jälkeen, kun se on kerran julkaistu.</font></p>
            <br>
            <!-- Kyselyn poistaminen -->
            <p><font color="black"><b>Kyselyn poisto<b></font></p>
            <FORM action="poisto.php?opettaja=<?php print $_GET['opettaja']; ?>" method="post">
                <input type="hidden" name="poisto" value="<?php print $_GET['kyselyid']; ?>">
                <input type="submit" value="Poista">
            </FORM> 
            <br>            
         </div>
            <!-- Paluulinkki -->
         <ul class="navbar">
            <li><p><a href="opettaja.php?opettaja=<?php print $_GET["opettaja"] ?>">Oma sivu</a></p></li>
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
