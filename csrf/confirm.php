<?php
session_start();

header("Content-type: text/html; charset=utf-8");

echo "<p>前画面から受け取ったトークン　".$_POST['token']."</p>";
echo "<p>生成したトークン　".hash('sha256', session_id())."</p>";

if(empty($_POST)) {
    $errors['wrong'] = "はじめの画面から進んで下さい。";
}else{
    //名前入力判定
    if (!isset($_POST['yourname'])  || $_POST['yourname'] === "" ){
        $errors['name'] = "名前が入力されていません。";
    }
    //トークン判定
    if ($_POST['token'] != hash('sha256', session_id()) ){
        $errors['token'] = "トークンが一致しません";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>クロスサイトリクエストフォージェリ</title>
</head>
<body>

<?php if (count($errors) === 0): ?>
    <p>トークンが一致しました。</p>
<?php elseif(count($errors) > 0): ?>
    <?php
    foreach($errors as $value){
        echo "<p>".$value."</p>";
    }
    ?>
<?php endif; ?>

</body>
</html>