<?php
function getDb() : PDO{
    $dsn = 'mysql:dbname=ecphp; host127.0.0.1; charset=utf8';
    $usr = 'selfusr';
    $passwd = 'selfpass';
$db = new PDO($dsn,$usr,$passwd);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   return $db;
}
?>