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


        if (sizeof($taulu) == 1) {
            print 'Kirjautuminen onnistui.';
            //echo count($taulu);
            //echo $email;
            //echo $salasana;
            //echo $testi;
            //echo $taulu;
            //header("location:login_success.php");
	    //header('Location: http://www.example.com');
        }
        else {
            echo 'Wrong Username or Password';
        }
        ?>
    </body>
