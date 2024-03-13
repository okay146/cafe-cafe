<?php
// データベースに接続
$db = 'mysql:dbname=cafe;host=mysql;port=3306;';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($db, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
    // 削除するID
    $id = $_GET['id'];

    // SQL文を準備して実行
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // // 削除が成功したら、HTTPレスポンスコードを設定して終了する
    // http_response_code(204); // No Content
    // exit();
} catch (PDOException $e) {
    echo "削除失敗:" . $e->getMessage() . "\n";
}
?>
