<?php
// Luodaan yhteenvetosivu kurssikyselystä
require_once 'DB.php';
session_start();
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="tyylit.css" />
    <title>Yhteenveto</title>
    <meta charset="utf-8">
</head>

<body>
    <?php
    // Istuntotarkastus
    if (isset($_SESSION["ihminen"])) {

        if (isset($_SESSION["kyselyid"])) {
            $kyselyid = $_SESSION["kyselyid"];
            unset($_SESSION["kyselyid"]);
        } else {
            $kyselyid = $_GET["luoyv"];
        }

        $yhteys = db::getDB();
        $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid = ?';
        $kyselynimi = $yhteys->prepare($sql);
        $kyselynimi->execute(array($kyselyid));
        $knimi = $kyselynimi->fetch();
        ?>
        <h1><?php print htmlspecialchars($knimi['kknimi']); ?></h1>
        <div class="box">
            <?php
            // Haetaan kaikki kysymykset taulukkoon $kysymykset
            $sqlk = 'SELECT kysymys, kysymysID FROM kysymys WHERE kurssikyselyid = ?';
            $sqlk2 = $yhteys->prepare($sqlk);
            $sqlk2->execute(array($kyselyid));
            $kysymykset = $sqlk2->fetchAll();
            $kokok = sizeof($kysymykset);

            // Käydään kaikki kysymykset läpi
            for ($i = 0; $i < $kokok; $i++) {
                echo "<h2>" . htmlspecialchars($kysymykset[$i][0]) . "</h2>";
                // Vastausten haku
                $sqlv = 'SELECT vastausarvo FROM vastaus WHERE kysymysid = ?';
                $sqlv2 = $yhteys->prepare($sqlv);
                $sqlv2->execute(array($kysymykset[$i][1]));
                $vastaukset = $sqlv2->fetchAll();
                $kokov = sizeof($vastaukset);
                $a = 0;
                $b = 0;
                $c = 0;
                $d = 0;
                $e = 0;
                // Käydään kaikki vastaukset läpi
                for ($j = 0; $j < $kokov; $j++) {
                    // Lasketaan vastausten määrät
                    if ($vastaukset[$j][0] == 1) {
                        $a++;
                    }
                    if ($vastaukset[$j][0] == 2) {
                        $b++;
                    }
                    if ($vastaukset[$j][0] == 3) {
                        $c++;
                    }
                    if ($vastaukset[$j][0] == 4) {
                        $d++;
                    }
                    if ($vastaukset[$j][0] == 5) {
                        $e++;
                    }
                }
                // Lasketaan jokaisen vastauksen suhde kokonaismäärään
                $maara1 = ($a / $kokov) * 100;
                $maara2 = ($b / $kokov) * 100;
                $maara3 = ($c / $kokov) * 100;
                $maara4 = ($d / $kokov) * 100;
                $maara5 = ($e / $kokov) * 100;
                echo "5: ";
                for ($ee = 0; $ee < $maara5 / 2; $ee++) {
                    echo "<font size='5'>•</font>";
                }
                // intval muuttaa doublen intiksi
                echo "<font size='2'> (" . intval((($e / $kokov) * 100)) . "%)</font>" . "<br>";
                echo "4: ";
                for ($dd = 0; $dd < $maara4 / 2; $dd++) {
                    echo "<font size='5'>•</font>";
                }
                echo "<font size='2'> (" . intval((($d / $kokov) * 100)) . "%)</font>" . "<br>";
                echo "3: ";
                for ($cc = 0; $cc < $maara3 / 2; $cc++) {
                    echo "<font size='5'>•</font>";
                }
                echo "<font size='2'> (" . intval((($c / $kokov) * 100)) . "%)</font>" . "<br>";
                echo "2: ";
                for ($bb = 0; $bb < $maara2 / 2; $bb++) {
                    echo "<font size='5'>•</font>";
                }
                echo "<font size='2'> (" . intval((($b / $kokov) * 100)) . "%)</font>" . "<br>";
                echo "1: ";
                for ($aa = 0; $aa < $maara1 / 2; $aa++) {
                    echo "<font size='5'>•</font>";
                }
                echo "<font size='2'> (" . intval((($a / $kokov) * 100)) . "%)</font>" . "<br>";
                // Lasketaan keskiarvo, (float) sprintf("%1.2f" x) muuttaa luvun x 2-desimaaliseksi luvuksi
                echo "<p>Keskiarvo: <b>" . (float) sprintf("%1.2f", ((($a * 1) + ($b * 2) + ($c * 3) + ($d * 4) + ($e * 5)) / $kokov)) . "</b><br>";
                echo "Vastauksia yhteensä: <b>" . $kokov . "</b><br><br>";

                // Kommentit näkyvät vain opettajille ja vastuuhenkilöille
                if ($_SESSION["ihminen"] != "tavis") {
                    ?>
                    <a href=kommentit.php?henkiloid=<?php print $_GET['henkiloid']; ?>&kysymysid=<?php print $kysymykset[$i][1]; ?>&kurssikyselyid=<?php print $_GET['luoyv']; ?>>Tarkastele kommentteja</a>
                    <?php
                    // Haetaan kommenttien lukumäärä
                    $sql = 'SELECT kommentti FROM Kommentti WHERE kysymysid = ?';
                    $sqlk = $yhteys->prepare($sql);
                    $sqlk->execute(array($kysymykset[$i][1]));
                    $sqlk2 = $sqlk->fetchAll();
                    print " (" . sizeof($sqlk2) . ")</p><br><br>";
                }
            }
            ?>
        </div>
        <ul class="navbar">
            <?php
            // Peruskäyttäjä pääsee julkiselle etusivulle
            if ($_SESSION["ihminen"] == "tavis") {
                ?>
                <li><p><a href=index.php>Etusivulle</a></p></li>

                <?php
                // Opettaja ja vastuuhenkilö pääsevät omalle etusivulleen
            } else if (isset($_SESSION["ihminen"])) {
                ?>
                <li><p><a href=yhteenveto.php?yhteenveto=<?php print $_GET['henkiloid']; ?>>Takaisin</a></p></li>
                <li><p><a href=index.php>Kirjaudu ulos</a></p></li>
                <?php
            }
            // Istuntotarkastus failaa
        } else {

            header("Location: access_denied.php");
        }
        ?>
    </ul>
</body>



