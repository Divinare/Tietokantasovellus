<?php
class DB {
     private $yhteys;
     public static function getDB() {
     if($yhteys == null) {
     $yhteys = new PDO("pgsql:");
     }
     return $yhteys;
     }
}
?>
