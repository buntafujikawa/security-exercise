<?php
session_start();

// パラメーター取得
$id = filter_input(INPUT_POST, "id");
$password = filter_input(INPUT_POST, "password");

$count = 0;

try{
    // 文字エンコーディングを必ず指定する
    // utf8mb4だと4バイトからなる絵文字なども正常に取り扱える
    $dbh = new PDO("mysql:host=localhost;dbname=test;charset=utf8mb4", "test", "test");

    // 静的プレースホルダを指定
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $dbh->prepare("SELECT COUNT(*) AS CNT from LOGIN WHERE ID = ? AND PASSWORD = ?;");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt->bindParam(1, $id, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);

    $stmt->execute();

    while ($row = $stmt->fetch()) {
        $count = $row["CNT"];
    }

    $stmt = null;

} catch(PDOException $e){
    echo $e->getMessage();
}

$_SESSION['id'] = $id;

if ($count == 1) {
    // ログイン成功
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: welcome.php");
} else {
    // ログイン失敗
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: login.php");
}
