<?php
    require_once 'DB.php';
    session_start();
    unset($_SESSION["ihminen"]);
?>
<!DOCTYPE html>

<head>
</head>

<body>
   <?php
   header("Location: index.php");
   ?>
</body>
