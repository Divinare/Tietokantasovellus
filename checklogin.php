<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>checklogin</title>
   <meta charset="utf-8">
</head>
     <body>
        <?php

        $email = $_POST['email'];
        $salasana = $_POST['salasana'];

	//heataan henkilöID
        $yhteys = db::getDB();
        $sql = "SELECT henkiloid FROM henkilo WHERE email = '".$email."' and salasana = '".$salasana."'";
       	$kysely = $yhteys->prepare($sql);
        $kysely->execute();
        $taulu = $kysely->fetchall();

	//haetaan henkilön rooli:
	$roolisql = "SELECT rooli FROM henkilo WHERE henkiloid =?";
	$roolik = $yhteys->prepare($roolisql);
	$roolik->execute(array($taulu[0][0]));
	$rooli = $roolik->fetchall();

	//$kirjautuminen = True;
        if (sizeof($taulu) == 1) {
            print 'Kirjautuminen onnistui.';
            //session_register("myusername");
            //session_register("mypassword");
            //header("location:login_success.php");
	    //if ($taulu[0][0] >= 1 && $taulu[0][0] <= 9) {
	    //if ($rooli[0][0] == "admin") {
	    $a = strcmp($rooli[0][0], "admin");
	    if ($a == 0) {
	    header("Location: admin.php?admin=".$taulu[0][0]);
	    }
	    $b = strcmp($rooli[0][0], "opettaja");
	    if ($b == 0) {
            header("Location: opettaja.php?opettaja=".$taulu[0][0]);
            }
	    $c = strcmp($rooli[0][0], "laitosva");
	    if ($c == 0) {
	    header("Location: laitosva.php?laitosva=".$taulu[0][0]);
	    }
        }
        else {
            //echo 'Wrong Username or Password';
            header('Location: http://joeniemi.users.cs.helsinki.fi/');
	    //$kirjautuminen = False;
	    }
        ?>
    </body>
