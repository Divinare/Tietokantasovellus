<?php
// Listaa käyttäjät roolin mukaan kolmeen eri taulukkoon
require_once 'DB.php';
session_start();
$yhteys = db::getDB();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Käyttäjälista</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    // Istuntotarkistus
    if ($_SESSION["ihminen"] == $_GET["hlista"]) {

        // Haetaan käyttäjän nimi otsikkoon
        $sql = 'SELECT etunimi, sukunimi FROM henkilo WHERE henkiloid = ?';
        $admin = $yhteys->prepare($sql);
        $admin->execute(array($_GET["hlista"]));
        $otsikko = $admin->fetch();

        // Haetaan tietokannasta kaikki adminit, opettajat ja laitosvastuuhenkilöt taulukoihin
        $kysely = 'SELECT etunimi, sukunimi, email, rooli, henkiloID FROM henkilo WHERE rooli = ?';
        $kyselyadmin = $yhteys->prepare($kysely);

        // Admin
        $kyselyadmin->execute(array(admin));
        $nimiT = $kyselyadmin->fetchAll();

        // Ope
        $kyselyadmin->execute(array(opettaja));
        $Opettajat = $kyselyadmin->fetchAll();

        // Vastuuhenkilö
        $kyselyadmin->execute(array(vastuuhenkilö));
        $Vastuuhenkilöt = $kyselyadmin->fetchAll();
        ?>

        <h1>Admin - <?php print $otsikko["etunimi"] . " " . $otsikko["sukunimi"]; ?></h1>
        <div class="box">
            <?php
            $nimi = "adminit";
            $nimi2 = "admin";

            // Tulostetaan 3 taulukkoa, jokaiselle roolille oma
            for ($rooli = 1; $rooli < 4; $rooli++) {
                ?>
                <h3>Käyttäjälista <?php print $nimi ?></h3>
                <table class="t">
                    <tr>
                        <th align = left>Etunimi</th>
                        <th align = left>Sukunimi</h>
                        <th align = left>Sähköposti</th>
                        <th align = left>Rooli</th>
                        <th align = left>HenkilöID</th>
                        <th> </th>
                    </tr>
                    <tr>
                        <?php
                        for ($i = 0, $size = sizeof($nimiT); $i < $size; ++$i) {
                            ?>
                            <td><?php print htmlspecialchars($nimiT[$i][0]); ?></td>
                            <td><?php print htmlspecialchars($nimiT[$i][1]); ?></td>
                            <td><?php print htmlspecialchars($nimiT[$i][2]); ?></td>
                            <td><?php print htmlspecialchars($nimi2); ?></td>
                            <td><?php print htmlspecialchars($nimiT[$i][4]); ?></td>
                            <td><FORM action="muokkaah.php?admin=<?php print $_GET['hlista']; ?>&henkiloid=<?php print $nimiT[$i][4]; ?>&viesti=tyhja" method="post">
                                    <input type="submit" value="Muokkaa">
                                </FORM></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
                // Vaihetaan roolia seuraavaa taulukkoa varten
                if ($rooli == 1) {
                    $nimiT = $Opettajat;
                    $nimi = "opettajat";
                    $nimi2 = "opettaja";
                }
                if ($rooli == 2) {
                    $nimiT = $Vastuuhenkilöt;
                    $nimi = "vastuuhenkilöt";
                    $nimi2 = "vastuuhenkilö";
                }
            }
            ?>
        </div>
        <ul class="navbar">
            <li><p><a href=admin.php?admin=<?php print $_GET["hlista"]; ?>>Oma sivu</a></p></li>
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
