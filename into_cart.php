<!-- 一度cart.phpに移動し商品をカートに入れる
その後、index.phpにリダイレクト -->
<?php
require_once 'DbManager.php';
$db = getDb();
$stt = $db->prepare('INSERT INTO cart(product_id,user_id)values(:product_id,:user_id)');
$stt->bindValue(':product_id',$_POST['product_id']);
$stt->bindValue(':user_id',$_POST['user_id']);
$stt->execute();
header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
?>