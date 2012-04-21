<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Yhteenveto - Greippikysely</title>
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
	   echo $kysymykset[$i][0];
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
             if ($vastaukset[$j][0] == 2) {
                $c++;
             }
             if ($vastaukset[$j][0] == 2) {
                $d++;
             }
             if ($vastaukset[$j][0] == 2) {
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
           for($ee = 0; $ee < $e; $ee++) {
               echo "•";
           }
        }

     ?>
</body>
