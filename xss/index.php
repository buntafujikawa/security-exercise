<?php
session_start();
?>
<html>
<body>
<h1>ユーザー情報登録</h1>
<form action="confirm.php" method="get">
    名前:<input type="text" name="name"><br/>
    URL:<input type="text" name="url"><br/>
    <input type="submit" value="確認">
    <input type="reset" value="リセット">
</form>
</body>
</html>