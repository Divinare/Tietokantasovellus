<?php
// Opettajan etusivu
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Opettaja</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // Istuntotarkastus
    if ($_SESSION["ihminen"] == $_GET["opettaja"]) {

        // Haetaan opettajan tiedot
        $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
        $kyselyopettaja = $yhteys->prepare($sql);
        $kyselyopettaja->execute(array($_GET["opettaja"]));
        $nimi = $kyselyopettaja->fetch();
        ?>
        <h1>Opettaja - <?php print $nimi[0] . " " . $nimi[1]; ?></h1>

        <?php
        // Haetaan opettajan luomien kyselyjen tiedot
        $sql2 = 'SELECT kknimi, esilla, ollutEsilla, kurssikyselyID, nimi, periodi, vuosi FROM kurssikysely INNER JOIN kurssi ON kurssikysely.kurssiid = kurssi.kurssiid AND kurssi.henkiloid = kurssikysely.henkiloid WHERE kurssi.henkiloID = ? ORDER BY vuosi DESC, kknimi';
        $kkyselyt = $yhteys->prepare($sql2);
        $kkyselyt->execute(array($_GET["opettaja"]));
        $kyselyt = $kkyselyt->fetchAll();

        // Jos opettajalla on omia kyselyjä, ne tulostetaan
        if (sizeof($kyselyt) > 0) {
            ?>
            <div class="box">
                <h3>Omat kyselyt</h3>
                <table>
                    <tr>
                        <th>Nimi</th>
                        <th>Kurssi</th>
                        <th>Näkyvyys</th>
                        <th>Julkaistu</th>
                        <th> </th>
                    </tr>
                    <tr>

                        <?php
                        foreach ($kyselyt as $k) {

                            if ($k['esilla']) {
                                $tila = 'Julkaistu';
                                $bo = TRUE;
                            }
                            else {
                                $tila = 'Piilossa';
                                $bo = FALSE;
                            }


                            if ($k['ollutesilla']) {
                                 $esi = 'Kyllä';
                            }
                            else {
                                 $esi = 'Ei';
                            }
                            ?>

                            <td><?php print $k['kknimi']; ?></td>
                            <td><?php print $k['nimi'] . " " . $k['periodi'] . "/" . $k['vuosi']; ?></td>
                            <td><?php print $tila; ?></td>
                            <td><?php print $esi; ?> </td>
                            <td><FORM action="muokkaa.php?opettaja=<?php print $_GET['opettaja']; ?>&kyselyid=<?php print $k['kurssikyselyid']; ?>" method='post'>
                                    <input type="hidden" name="tila" value="<?php print $bo; ?>">
                                    <input type="submit" value="Muokkaa">   
                                </FORM>
                            </td>

                        </tr>
                    <?php } ?>

                </table>
            </div>
            <?php
            // Jos opettajalla ei ole kyselyjä, siitä ilmoitetaan
        } else {
            ?>
            <div class="box">
                <h3>Omat kyselyt</h3>
                <table border="0" cellpadding="3">
                    <tr>
                        <td>(tyhjä)</td>
                    </tr>
                </table>
            </div>
            <?php
        }
        ?>
        <ul class="navbar">

            <li><p> <a href=valitse_kurssi.php?opettaja=<?php print $_GET["opettaja"]; ?>>Luo uusi kysely</a></p></li>

            <li><p> <a href=yhteenveto.php?yhteenveto=<?php print $_GET["opettaja"]; ?>>Omien kurssikyselyiden tulokset</a></p></li>

            <li><p> <a href=vaihdasala.php?vaihdasala=<?php print $_GET["opettaja"]; ?>>Salasanan vaihto</a></p></li>

            <li><p> <a href=hkursseja.php?opettaja=<?php print $_GET["opettaja"]; ?>>Hallinnoi kursseja</a></p></li>

            <li><p> <a href=index.php>Kirjaudu ulos</a></p></li>
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



