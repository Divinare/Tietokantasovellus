<?php require_once 'DB.php';

       $yhteys = db::getDB();

       if (empty($_POST['ukysymys'])) {
           header("Location: muokkaa.php?opettaja=".$_GET['opettaja']."&kyselyid=".$_GET['kyselyid']); die();
       }

       // Uuden kysymyksen lisääminen tietokantaan
       $ukysymys = $_POST["ukysymys"];
       $sql0 = 'INSERT INTO Kysymys VALUES (?, ?)';
       $lisays = $yhteys->prepare($sql0);
       $lisays->execute(array($ukysymys, $_GET["kyselyid"]));

       header("Location: muokkaa.php?opettaja=".$_GET["opettaja"]."&kyselyid=".$_GET['kyselyid']); die();


//header("Location: uusi.php?opettaja=".$_GET["opettaja"]."&&kyselyid=".$kkid[0]); die();


   ?>
</body>
