<?php
require_once 'DbManager.php';

$response = ['success' => false]; // 初期化

try {
    $db = getDb();
    $stt = $db->prepare('INSERT INTO cart(product_id, user_id) VALUES (:product_id, :user_id)');
    $stt->bindValue(':product_id', $_POST['product_id']);
    $stt->bindValue(':user_id', $_POST['user_id']);
    $stt->execute();

    $response['success'] = true; // 成功した場合
} catch (PDOException $e) {
    $response['message'] = $e->getMessage(); // エラーメッセージを格納
}

header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
?>