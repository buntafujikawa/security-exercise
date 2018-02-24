<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
<h1>ようこそ、<?php echo htmlspecialchars($_SESSION['id'], ENT_QUOTES, "UTF-8") ?>さん</h1>
</body>
</html>