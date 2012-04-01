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

        $yhteys = db::getDB();
        $sql = "SELECT henkiloid FROM henkilo WHERE email = '".$email."' and salasana = '".$salasana."'";
       	$kysely = $yhteys->prepare($sql);
        $kysely->execute();
        $taulu = $kysely->fetchall();
        // print "</br>".sizeof($taulu)."</br>";

	//$kirjautuminen = True;
        if (sizeof($taulu) == 1) {
            print 'Kirjautuminen onnistui.';
            //session_register("myusername");
            //session_register("mypassword");
            //header("location:login_success.php");
	    print $taulu['henkiloid'];
            print $taulu[0][0];

        }
        else {
            echo 'Wrong Username or Password';
            header('Location: http://joeniemi.users.cs.helsinki.fi/');
	    //$kirjautuminen = False;
	    }
        ?>
    </body>
