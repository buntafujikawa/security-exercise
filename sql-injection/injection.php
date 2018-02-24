<?php
// loginCheck.phpを少し変えただけ
session_start();

// パラメーター取得
$id = filter_input(INPUT_POST, "id");
$password = filter_input(INPUT_POST, "password");

$count = 0;

try {
    // 文字エンコーディングを指定しない
    $pdo = new PDO("mysql:host=localhost;dbname=test;", "test", "test");

    // 静的プレースホルダを使わずに直で変数をクエリの中で使う
    $stmt = $pdo->query('SELECT COUNT(*) AS CNT from LOGIN WHERE ID = ' . $id . ' AND PASSWORD = "' . $password . '" ;');

    while ($row = $stmt->fetch()) {
        $count = $row["CNT"];
    }

    $stmt = null;

} catch (PDOException $e) {
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
