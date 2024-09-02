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

<?php
$db = getDb();
$stt = $db->prepare('SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE user_id = :session_id;');
$stt->bindValue(':session_id',$_SESSION['user_id']);
$stt->execute();
$count = $db->prepare('SELECT COUNT(*) as item_num FROM cart WHERE user_id = :session_id;');
$count->bindValue(':session_id',$_SESSION['user_id']);
$count->execute();
$sum_price = 0;
foreach($stt as $item){
   
  print  $item['name'].'<br>';
  print '¥'.$item['price'].'<br>';
  $sum_price += $item['price'];
}
print $count->fetchColumn().'点<br>';
print $sum_price.'円';
?>
</body>
</html>
