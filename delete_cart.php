<?php
require_once 'DbManager.php';
if (!isset($_POST['delete_id'])) {
    die('不正なリクエストです。');
}
try{
    $db = getDb();
    $stt = $db->prepare('DELETE FROM cart WHERE cart_id = :delete_id');
    $stt->bindValue(':delete_id',$_POST['delete_id']);
    $stt->execute();
    header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/cart.php');
 
}
catch(PDOException $e){
    die("エラーメッセージ:{$e->getMessage()}");
}