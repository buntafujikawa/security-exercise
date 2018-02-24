<?php
session_start();

$name = filter_input(INPUT_GET, "name");
$url = filter_input(INPUT_GET, "url");

function escape(string $string) : string
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>
<html>
<body>
<h1>ユーザー情報登録確認</h1>
<form action="regist.php" method="get">
    名前:<?=$name?><br/>
    URL:<?=escape($url);?><br/>
    <input type="hidden" name="name" value="<?=$name?>">
    <input type="hidden" name="url" value="<?=escape($url);?>">
    <input type="submit" value="登録">
    <input type="button" value="戻る" onclick="javascript:history.back();">
</form>
</body>
</html>