<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Henkilön lisäys</title>
   <meta charset="utf-8">
</head>

<body>

<?php

   $yhteys = db::getDB();
   // Koitetaan hakea sähköposti tietokannasta (kahta samaa sähköpostia ei saa olla)
   $sql = "SELECT email FROM henkilo WHERE email = ?";
   $kysely = $yhteys->prepare($sql);
   $kysely->execute(array($_POST['sposti']));
   $taulu = $kysely->fetch();
   // Tarkistetaan onko kentät täytetty oikein
   if (empty($_POST['etu'])) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=etupuuttui"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if (strlen($_POST['etu']) > 30) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=etupitkä"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }

   if (empty($_POST['suku'])) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=sukupuuttui"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if (strlen($_POST['suku']) > 30) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=sukupitkä"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }

   if (empty($_POST['sposti'])) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=emailpuuttui"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if (strlen($_POST['sposti']) > 30) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=emailpitkä"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if (strlen($taulu[0][0] > 0)) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=emailkäytössä"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if (empty($_POST['passu'])) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=salapuuttui"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if (strlen($_POST['passu']) > 30) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=salapitkä"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   if ($_POST['passu'] != $_POST['passu2']) {
   header("Location: hlisays.php?hlisays=".$_GET["lisays"]."&viesti=salateitäsmää"."&etu=".$_POST['etu']."&suku=".$_POST['suku']."&sähkö=".$_POST['sposti']); die();
   }
   ?>
   <h2>Vahvista alla olevat tiedot:</h2>
   <b>ETUNIMI:</b>     <?php echo $_POST['etu']; ?> </br>
   <b>SUKUNIMI:</b>    <?php echo $_POST['suku']; ?> </br>
   <b>SÄHKÖPOSTI:</b>  <?php echo $_POST['sposti']; ?> </br>
   <b>SALASANA:</b>    <?php echo $_POST['passu']; ?> </br>
   <b>ROOLI:</b>       <?php echo $_POST['rooli']; ?> </br>

   <Form name ='tiedot' Method ='Post' ACTION ='lomakelahetys.php?lomakelahetys=<?php print $_GET['lisays']; ?>'>
   <input type='hidden' name='etu' value='<?php print $_POST['etu']; ?>'>
   <input type='hidden' name='suku' value='<?php print $_POST['suku']; ?>'>
   <input type='hidden' name='sposti' value='<?php print $_POST['sposti']; ?>'>
   <input type='hidden' name='passu' value='<?php print $_POST['passu']; ?>'>
   <input type='hidden' name='rooli' value='<?php print $_POST['rooli']; ?>'>
   <Input type = 'Submit' Name = 'submit' Value = 'Vahvista tiedot'>
   </form>

   <p><a href=admin.php?admin=<?php print $_GET['lisays']; ?>>Takaisin</a></p>
   </FORM>
</body>
