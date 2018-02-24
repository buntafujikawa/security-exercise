<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
<h1>ログイン</h1>
<form action="loginCheck.php" method="post">
    ID:<input type="text" name="id"><br>
    Password:<input type="password" name="password"><br>
    <input type="submit" value="ログイン">
    <input type="reset" value="リセット">
</form>

<h1>SQLインジェクションできるログインフォーム</h1>
<form action="injection.php" method="post">
    ID:<input type="text" name="id"><br>
    Password:<input type="password" name="password"><br>
    <input type="submit" value="ログイン">
    <input type="reset" value="リセット">
</form>
</body>
</html>