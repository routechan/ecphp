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

<!-- アイテムの情報 -->
<div class="item__info">
   <p><?=$product['name'];?></p>
   <!-- 評価の数字を星に変換 -->
   <p class="item__info-review"><?php switch($product['review']){
    case 1:
        print '☆☆☆☆★';
        break;
    case 2:
        print '☆☆☆★★';
        break;
        case 3:
            print '☆☆★★★';
            break;
            case 4:
                print '☆★★★★';
                break;
                case 5;
                print'★★★★★';
                break;
   };?></p> 
   <div class="item__flex">
   <p>¥<?=$product['price'];?></p>
   <form class="form" method="post" action="into_cart.php">
    <!-- product['id']とuser_idをhiddenでinto_cart.phpに送る -->
    <input class="form__product-id" type="hidden" name="product_id" value="<?=$product['id']?>">
    <input class="form__user-id" type="hidden" name="user_id" value="<?=$user_id;?>">
   <button class="form__btn" name="send" type="submit">カートに入れる</button>
   </form>
   </div>
</div>
<?php }?>
        </li>
    </ul>
</div>
        </main>
<!-- <script src="js/main.js"></script> -->
</body>
</html>

