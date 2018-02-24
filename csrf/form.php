<?php
session_start();

header("Content-type: text/html; charset=utf-8");

echo "<p>セッションIDです　".session_id()."</p>";
echo "<p>生成したトークン　".hash('sha256', session_id())."</p>";

?>

<!DOCTYPE html>
<html>
<head>
    <title>クロスサイトリクエストフォージェリ</title>
</head>
<body>

<p>以下で送信します。<p>
<form action="confirm.php" method="post">
    名前：<input type="text" name="yourname" value="hoge">
    <input type="hidden" name="token" value="<?=hash('sha256', session_id())?>">
    <input type="submit" value="送信">
</form>

<p>外部のサイトに送信する。<p>
<form action="http://noumenon-th.net/programming/sample/php/csrf2.php" method="post">
    名前：<input type="text" name="yourname" value="fuga">
    <input type="hidden" name="token" value="<?=hash('sha256', session_id())?>">
    <input type="submit" value="送信">
</form>

</body>
</html>