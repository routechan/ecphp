<?php
require_once 'DbManager.php';
session_start();?>

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

<div id="cart" class="wrapper">
  <div class="main">
<?php
$db = getDb();
$stt = $db->prepare('SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = :session_id;');
$stt->bindValue(':session_id',$_SESSION['user_id']);
$stt->execute();
$count = $db->prepare('SELECT COUNT(*) as item_num FROM cart WHERE user_id = :session_id;');
$count->bindValue(':session_id',$_SESSION['user_id']);
$count->execute();
$sum_price = 0;
foreach($stt as $item){;?>
   
<div class="main__card">
  <img class="main__card-image" src="image/<?=$item['image'];?>">
  <div class="main__card-info">
    <div class="main__card-text">
    <p class="main__card-name"><?php print $item['name'];?></p>
    <p class="main__card-price"><?php print '¥'.$item['price'];
    $sum_price += $item['price'];//商品の合計金額を計算
    ?>
    </p>
    </div>
    <div class="main__card-option">
        <!-- カートから削除する機能 -->
  <form class="main__card-delete" action='delete_cart.php' method='post'>
  <input type='hidden' name='delete_id' value='<?=$item["cart_id"];?>' >
    <button type='submit'>カートから削除</button>

  </form>
    </div>

  </div>

</div>

 <?php }

?>
  </div>

  <div class="side">
    <p>合計点数:<?php print $count->fetchColumn().'点';?></p>
    <p>計:¥<?php print $sum_price;?></p>
    <form>
      <button class="form__btn" type="submit">購入する</button>
    </form>
  </div>
</div>
</body>
</html>
