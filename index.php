<?php 
require_once 'DbManager.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    // 初めてのアクセスの場合、ユニークなIDを生成
    // $_SESSION['user_id']にユニークなidを保存
    $_SESSION['user_id'] = uniqid('user_', true);
}

// クライアントの識別子
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css"
/>
<link rel="stylesheet" href="scss/style.css">

</head>
<body>
   
       <?php include "header.html";?>
        <main>
            <?php
$db = getDb();
$stt = $db->prepare('SELECT * FROM products');
$stt->execute();
?>

<div id="product" class="wrapper">
    <ul class="item-list">
   <?php foreach($stt as $product){
    ?>
        <li class="item">
            <div class="image-outer">
<img src="image/<?=$product['image']?>">
            </div>
<div>
   <p><?=$product['name'];?></p>
   <p><?=$product['review'];?></p> 
   <div class="item__flex">
   <p>¥<?=$product['price'];?></p>
   <form method="post" action="into_cart.php">
    <!-- product['id']とuser_idをhiddenでinto_cart.phpに送る -->
    <input type="hidden" name="product_id" value="<?=$product['id']?>">
    <input type="hidden" name="user_id" value="<?=$user_id;?>">
   <input type="submit" value="カートに入れる">
   </form>
   </div>
</div>
        </li>
 <?php };?>
       developブランチで追記
    </ul>
</div>
        </main>
    
</body>
</html>

