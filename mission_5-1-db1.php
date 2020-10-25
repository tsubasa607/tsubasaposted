<?php
//DB設定:名前　tb-220701 Mysqlホスト名　localhost パスワード Ju7fyscw2L
$dsn='データベース名';
$user='ユーザー名';
$passward='パスワード';
$pdo=new PDO($dsn,$user,$passward, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS tsubasabox"//tbtestという名前のテーブル。もしこの名のテーブルがなければという条件付き。
."("//始まり。
."id INT AUTO_INCREMENT PRIMARY KEY,"//id欄。自動で登録されている
."name char(32),"
."comment TEXT,"//コメント欄。文字列、長めの文も入る
."date DATETIME"//次の列がないので,はいらない。DATETIMEで時刻を入れれる。
.");";//終わり。)の後の;を忘れずに
$stmt=$pdo->query($sql);

?>