<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Henkilön Lisäys</title>
   <meta charset="utf-8">
</head>

<body>
   <h1>Henkilön Lisäys</h1>

   <Form name ='henkilotiedot' Method ='Post' ACTION ='lisays.php?lisays=<?php print $_GET['hlisays']; ?>'>

      <p>Etunimi:</p>
      <input type='text' name='etu' value='<?php print $_GET["etu"] ?>'>
      <?php
           if ($_GET["viesti"] == "etupuuttui") {
                print "<font color='red'>Et antanut etunimeä.<font color='black'>";
           }
           if ($_GET["viesti"] == "etupitkä") {
                print "<font color='red'>Etunimi liian pitkä - sallittu pituus 1-30 merkkiä.<font color='black'>";
           }
      ?>

      <p>Sukunimi:</p>
      <input type='text' name='suku' value='<?php print $_GET["suku"] ?>'>
      <?php
           if ($_GET["viesti"] == "sukupuuttui") {
                print "<font color='red'>Et antanut sukunimeä.<font color='black'>";
           }
           if ($_GET["viesti"] == "sukupitkä") {
                print "<font color='red'>Sukunimi liian pitkä - sallittu pituus 1-30 merkkiä.<font color='black'>";
           }
      ?>

      <p>Sähköposti:</p>
      <input type='text' name='sposti' value='<?php print $_GET["sähkö"] ?>'>
      <?php
           if ($_GET["viesti"] == "emailpuuttui") {
           print "<font color='red'>Et antanut sähköpostia.<font color='black'>";
           }
           if ($_GET["viesti"] == "emailpitkä") {
           print "<font color='red'>Sähköposti oli liian pitkä - sallittu pituus 1-80 merkkiä.<font color='black'>";
           }
           if ($_GET["viesti"] == "emailkäytössä") {
           print "<font color='red'>Sähköposti on jo käytössä.<font color='black'>";
           }
      ?>

      <p>Salasana:</p>
      <input type='password' name='passu'>
      <?php
           if ($_GET["viesti"] == "salapuuttui") {
                print "<font color='red'>Et antanut salasanaa.<font color='black'>";
           }
           if ($_GET["viesti"] == "salapitkä") {
                print "<font color='red'>Salasana liian pitkä - sallittu pituus 1-15 merkkiä.<font color='black'>";
           }
           if ($_GET["viesti"] == "salateitäsmää") {
                print "<font color='red'>Salasanat eivät täsmänneet.<font color='black'>";
           }
      ?>

      <p>Vahvista salasana:</p>
      <input type='password' name='passu2'>

      <p>Rooli:</p>
      <input type="radio" name="rooli" value="opettaja" checked> Opettaja </br>
      <input type="radio" name="rooli" value="admin"> Admin </br>
      <input type="radio" name="rooli" value="vastuuhenkilö"> Laitoksen vastuuhenkilö </br>

      <Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>

      <p><a href=admin.php?admin=<?php print $_GET['hlisays']; ?>>Takaisin</a></p>

   </form>
</body>
