<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <?php
     $yhteys = db::getDB();

     $sql = 'SELECT kknimi FROM kurssikysely WHERE kurssikyselyid ='.$_GET["kysely"];
     $kyselytitle = $yhteys->prepare($sql);
     $kyselytitle->execute();
     $htmltitle = $kyselytitle->fetch();
     echo "<title>".$htmltitle['kknimi']."</title>";
   ?>
     <meta charset="utf-8">
</head>
       <body>

         <?php
            echo "<h1>".$htmltitle['kknimi']."</h1>"."</br>";

            $kysely = 'SELECT kysymys, kysymysid FROM kysymys WHERE kurssikyselyid ='.$_GET["kysely"];

            print "<Form name ='vastaukset' Method ='Post' ACTION ='end.php?kysely=".$_GET["kysely"]."'>";

            $indeksi = 0;
               foreach ($yhteys->query($kysely) as $tulos) {

                   print "<h3>".$tulos['kysymys']."</h3>";

                    print "<Input type = 'Radio' Name ='arvosana[".$indeksi."]' value= '1'>1";
                    print "<Input type = 'Radio' Name ='arvosana[".$indeksi."]' value= '2'>2";
                    print "<Input type = 'Radio' Name ='arvosana[".$indeksi."]' value= '3'>3";
                    print "<Input type = 'Radio' Name ='arvosana[".$indeksi."]' value= '4'>4";
                    print "<Input type = 'Radio' Name ='arvosana[".$indeksi."]' value= '5'>5";
                    print "</br></br>";


                    print 'Kommentti (max. 300 merkkiä)'."</br>";
                    print "<textarea Name= 'kommentti[".$indeksi."]' rows='4' cols='30'></textarea>"."</br></br>";

                    print "<input type='hidden' name='kysymysidt[".$indeksi."]' value='".$tulos['kysymysid']."'>";

                    $indeksi = $indeksi + 1;
              }
           print "<Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>";
           print "</form>";
          ?>
       </body>
