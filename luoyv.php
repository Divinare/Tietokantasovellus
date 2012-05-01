<?php require_once 'DB.php'; ?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
   <title>Yhteenveto</title>
   <meta charset="utf-8">
</head>

<body>
     <?php
        $yhteys = db::getDB();
        $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid = ?';
        $kyselynimi = $yhteys->prepare($sql);
        $kyselynimi->execute(array($_GET["luoyv"]));
        $knimi = $kyselynimi->fetch();
	echo "<h2>".$knimi['kknimi']."</h2>";

        // Haetaan kaikki kysymykset taulukkoon $kysymykset
        $sqlk = 'SELECT kysymys, kysymysID FROM kysymys WHERE kurssikyselyid = ?';
        $sqlk2 = $yhteys->prepare($sqlk);
        $sqlk2->execute(array($_GET["luoyv"]));
        $kysymykset = $sqlk2->fetchAll();
        $kokok = sizeof($kysymykset);

        for ($i = 0; $i < $kokok; $i++) {
	   echo $kysymykset[$i][0]."<br>";
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
           for ($j = 0; $j < $kokov; $j++) {
             //echo $vastaukset[$j][0];
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
	   $maara1 = ($a/$kokov)*100;
	   $maara2 = ($b/$kokov)*100;
           $maara3 = ($c/$kokov)*100;
           $maara4 = ($d/$kokov)*100;
           $maara5 = ($e/$kokov)*100;
           echo "5: ";
           for ($ee = 0; $ee < $maara5/2; $ee++) {
               echo "<font size='5'>•</font>";
           }
	   // intval muuttaa doublen intiksi
	   echo "<font size='2'> (".intval((($e/$kokov)*100))."%)</font>"."<br>";
	   echo "4: ";
	   for ($dd = 0; $dd < $maara4/2; $dd++) {
               echo "<font size='5'>•</font>";
           }
	   echo "<font size='2'> (".intval((($d/$kokov)*100))."%)</font>"."<br>";
	   echo "3: ";
	   for ($cc = 0; $cc < $maara3/2; $cc++) {
	       echo "<font size='5'>•</font>";
	   }
	   echo "<font size='2'> (".intval((($c/$kokov)*100))."%)</font>"."<br>";
	   echo "2: ";
           for ($bb = 0; $bb < $maara2/2; $bb++) {
               echo "<font size='5'>•</font>";
           }
	   echo "<font size='2'> (".intval((($b/$kokov)*100))."%)</font>"."<br>";
	   echo "1: ";
           for ($aa = 0; $aa < $maara1/2; $aa++) {
               echo "<font size='5'>•</font>";
           }
           echo "<font size='2'> (".intval((($a/$kokov)*100))."%)</font>"."<br>";
	   // Lasketaan keskiarvo, (float) sprintf("%1.2f" x) muuttaa luvun x 2-desimaaliseksi luvuksi
           echo "Keskiarvo: ".(float) sprintf("%1.2f", ((($a*1)+($b*2)+($c*3)+($d*4)+($e*5))/$kokov))."<br>";
	   echo "Vastauksia yhteensä: ".$kokov."<br>";
           ?>
           // Haetaan rooli, koska kommentit saa nähdä vain opettaja tai laitosvastaava
           //$sqlr = 'SELECT rooli FROM Henkilo WHERE henkiloid = ?
           <a href=kommentit.php?henkiloid=<?php print $_GET['henkiloid']; ?>&kysymysid=<?php print $kysymykset[$i][1]; ?>&kurssikyselyid=<?php print $_GET['luoyv']; ?>>Tarkastele kommentteja</a>
           <?php
           // Haetaan kommenttien lukumäärä
           $sql = 'SELECT kommentti FROM Kommentti WHERE kysymysid = ?';
           $sqlk = $yhteys->prepare($sql);
           $sqlk->execute(array($kysymykset[$i][1]));
           $sqlk2 = $sqlk->fetchAll();
           print " (".sizeof($sqlk2).")<br><br>";
       }
      ?>
     <p><a href=yhteenveto.php?yhteenveto=<?php print $_GET['henkiloid']; ?>><img src="nuoli.png" border="0" /></a></p>
</body>
