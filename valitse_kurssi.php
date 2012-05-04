<?php
// Kurssinvalintasivu uuden kyselyn luonnissa
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Uusi kysely - Kurssi</title>
    <meta charset="utf-8">
</head>
<body>

    <h1>Valitse kurssi</h1>
    <div class="box">

        <?php
        // Istuntotarkastus
        if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

            // Haetaan kurssin tiedot
            $sql = 'SELECT nimi, vuosi, periodi, kurssiID FROM kurssi WHERE henkiloID = ?';
            $kurssi = $yhteys->prepare($sql);
            $kurssi->execute(array($_GET["opettaja"]));
            $kurssit = $kurssi->fetchAll();

            // Jos kannassa on tallennettuja kursseja, ne tulostetaan
            if (sizeof($kurssit) > 0) {
                ?>
                <table border="0" cellpadding="3">
                    <tr>
                        <th align = left>Nimi</th>
                        <th align = left>Periodi</th>
                        <th align = left>Vuosi </th>
                        <th> </th>
                    </tr>
                    <tr>

                        <?php
                        foreach ($kurssit as $k) {
                            ?>
                            <td><?php print htmlspecialchars($k['nimi']); ?></td>
                            <td><?php print htmlspecialchars($k['periodi']); ?></td>
                            <td><?php print htmlspecialchars($k['vuosi']); ?></td>
                            <td><Form action="luo_kysely.php?opettaja=<?php print $_GET['opettaja']; ?>" method="post">
                                    <input type="hidden" name="knimi" value="<?php print $k['nimi']; ?>">
                                    <input type="hidden" name="periodi" value="<?php print $k['periodi']; ?>">
                                    <input type="hidden" name="vuosi" value="<?php print $k['vuosi']; ?>">
                                    <input type="hidden" name="kurssiid" value="<?php print $k['kurssiid']; ?>">
                                    <input type="submit" value="Valitse">
                                </Form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <br>
                <p><a href=kurssi.php?opettaja=<?php print $_GET["opettaja"] ?>&mista=l>Lisää uusi kurssi</a></p>

                <?php
                // Jos kannassa ei ole kursseja, siitä ilmoitetaan
            } else {
                ?>
                <table>
                    <tr>
                        <th align = left>Nimi</th>
                        <th align = left>Periodi</th>
                        <th align = left>Vuosi </th>
                        <th> </th>
                        <th> </th>

                    </tr>
                    <tr>
                        <td>(tyhjä)</td>
                    </tr>
                </table>
                <br>
                <p><a href=kurssi.php?opettaja=<?php print $_GET["opettaja"] ?>&mista=l>Lisää uusi kurssi</a></p>

            </div>

            <?php
        }

        // Kurssinpoistoilmoitukset
        if ($_GET["viesti"] == "OK!") {
            print "<p><font color='Red'> Poisto onnistui!</p>";
        } else if ($_GET["viesti"] == "v") {
            print "<p><font color='Red'> Kurssiin, jonka yritit poistaa, liittyy kurssikyselyitä. Poista ensin kurssiin liittyvät kurssikyselyt ja yritä sitten uudelleen.</p>";
        }
        ?>
        <br>
        <!-- Muut toiminnot linkkeinä -->
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
