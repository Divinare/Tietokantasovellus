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
        $sql = "SELECT henkiloid FROM henkilo WHERE email =? and salasana =?";
       	$kysely = $yhteys->prepare($sql);
        $kysely->execute(array($email, $salasana));
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

	    $a = strcmp($rooli[0][0], "admin");
	    if ($a == 0) {
	    header("Location: admin.php?admin=".$taulu[0][0]);
	    }
	    $b = strcmp($rooli[0][0], "opettaja");
	    if ($b == 0) {
            header("Location: opettaja.php?opettaja=".$taulu[0][0]);
            }
	    $c = strcmp($rooli[0][0], "vastuuhenkilö");
	    if ($c == 0) {
	    header("Location: vastuuhenkilö.php?vastuuhenkilö=".$taulu[0][0]);
	    }
        }
        else {
            //echo 'Wrong Username or Password';
            header("Location: index.php");
	    //$kirjautuminen = False;
	    }
        ?>
    </body>
