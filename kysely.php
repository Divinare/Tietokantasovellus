<?php
// Tämä tiedosto tulostaa nettisivulle kurssikyselyn, johon käyttäjä voi vastata
require_once 'DB.php';
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="tyylit.css" />
<head>
   <?php
     $yhteys = db::getDB();

     $sql = 'SELECT kknimi, etunimi, sukunimi FROM kurssikysely INNER JOIN henkilo ON kurssikysely.henkiloid = henkilo.henkiloid WHERE kurssikyselyid = ?';
     $kyselytitle = $yhteys->prepare($sql);
     $kyselytitle->execute(array($_GET["kysely"]));
     $htmltitle = $kyselytitle->fetch();
     echo "<title>".$htmltitle['kknimi']."</title>";
   ?>
     <meta charset="utf-8">
</head>
<body>
              <h1><?php print $htmltitle['kknimi']; ?><br><font size = "3"><?php print $htmltitle['etunimi']."  ".$htmltitle['sukunimi'];?></h1></br>

             <Form name ='vastaukset' Method ='Post' ACTION ='end.php?kysely= <?php print $_GET["kysely"]; ?>'>

       <?php
                 $kysely = 'SELECT kysymys, kysymysid FROM kysymys WHERE kurssikyselyid ='.$_GET["kysely"];
                 $indeksi = 0;
                 foreach ($yhteys->query($kysely) as $tulos) {
       ?>
                    <h3> <?php print $tulos['kysymys']; ?> </h3>

                    <Input type = 'Radio' Name ='arvosana[<?php print $indeksi; ?>]' value= '1'>1
                    <Input type = 'Radio' Name ='arvosana[<?php print $indeksi; ?>]' value= '2'>2
                    <Input type = 'Radio' Name ='arvosana[<?php print $indeksi; ?>]' value= '3'>3
                    <Input type = 'Radio' Name ='arvosana[<?php print $indeksi; ?>]' value= '4'>4
                    <Input type = 'Radio' Name ='arvosana[<?php print $indeksi; ?>]' value= '5'>5
                    </br></br>


                    <p>Kommentti (max. 300 merkkiä)</p>
                    <textarea Name= 'kommentti[<?php print $indeksi; ?>]' rows='4' cols='30'></textarea></br></br>
                    <input type='hidden' name='kysymysidt[<?php print $indeksi; ?>]' value='<?php print $tulos['kysymysid'];?>'>

                    <?php $indeksi++; }?>

             <Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>
             </form>
             <p><a href="index.php">Takaisin</a></p>
</body>
