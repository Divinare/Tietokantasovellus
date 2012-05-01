<?php
// Tämä tiedosto tulostaa nettisivulle kurssikyselyn, johon käyttäjä voi vastata
     require_once 'DB.php';
     session_start();

     $_SESSION["ihminen"] = "tavis";
     $_SESSION["kyselyid"] = $_POST["kyselyid"];

     $yhteys = db::getDB();

     $sql = 'SELECT kknimi, etunimi, sukunimi FROM kurssikysely INNER JOIN henkilo ON kurssikysely.henkiloid = henkilo.henkiloid WHERE kurssikyselyid = ?';
     $kyselytitle = $yhteys->prepare($sql);
     $kyselytitle->execute(array($_POST["kyselyid"]));
     $htmltitle = $kyselytitle->fetch();

     $kysely = 'SELECT kysymys, kysymysid FROM kysymys WHERE kurssikyselyid = ?';
     $tulokset = $yhteys->prepare($kysely);
     $tulokset->execute(array($_POST["kyselyid"]));
     $tuloss = $tulokset->fetchAll();

?>
<!DOCTYPE html>
<head>
     <link rel="stylesheet" type="text/css" href="tyylit.css" />
     <title><?php print $htmltitle['kknimi']; ?></title>
     <meta charset="utf-8">
</head>
<body>
              <h1><?php print $htmltitle['kknimi']; ?><br><font size = "3"><?php print $htmltitle['etunimi']."  ".$htmltitle['sukunimi'];?></h1></br>

             <Form name ='vastaukset' Method ='Post' ACTION ='end.php'>

       <?php
                 $indeksi = 0;

                   foreach ($tuloss as $tulos) {
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
             <p><a href="index.php"><img src="nuoli.png" border="0" /></a></p>
</body>
