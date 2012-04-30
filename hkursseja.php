<?php
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
    <title>Uusi kysely - Kurssi</title>
    <meta charset="utf-8">
</head>
<body>

    <h1>Omat kurssit</h1>

    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

        $sql = 'SELECT nimi, vuosi, periodi, kurssiID FROM kurssi WHERE henkiloID = ?';
        $kurssi = $yhteys->prepare($sql);
        $kurssi->execute(array($_GET["opettaja"]));
        $kurssit = $kurssi->fetchAll();
    ?>
    <ul class="box">
    <?php
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
                        <td><?php print $k['nimi']; ?></td>
                        <td><?php print $k['periodi']; ?></td>
                        <td><?php print $k['vuosi']; ?></td>
                        <td><Form action="poista_kurssi.php?opettaja=<?php print $_GET['opettaja']; ?>&mista=h" method="post">
                                <input type="hidden" name="kurssiid" value="<?php print $k['kurssiid']; ?>">
                                <input type="submit" value="Poista">
                            </Form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            </br>
            <?php
            // Jos kannassa ei ole kursseja, siitä ilmoitetaan
        } else {
            ?>
            <table border="0" cellpadding="3">
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
            </br>


            <?php
        }
        ?>
        </ul>
        <?php
        // Kurssinpoistoilmoitukset
        if ($_GET["viesti"] == "OK!") {
            print "<p><font color='Red'> Poisto onnistui!</p>";
        } else if ($_GET["viesti"] == "v") {
            print "<p><font color='Red'> Kurssiin, jonka yritit poistaa, liittyy kurssikyselyitä. Poista ensin kurssiin liittyvät kurssikyselyt ja yritä sitten uudelleen.</p>";
        }
        ?>
        </br>
        <!-- Muut toiminnot linkkeinä -->
        <ul class="navbar">
           <li><p><a href=kurssi.php?opettaja=<?php print $_GET["opettaja"] ?>&mista=h>Lisää uusi kurssi</a></p>
           <li><p><a href="opettaja.php?opettaja=<?php print $_GET["opettaja"] ?>">Oma sivu</a></p>
        </ul>
        <?php
        // Istuntotarkastus failaa
    } else {
        header("Location: access_denied.php");
        die();
    }
    ?>
</body>
