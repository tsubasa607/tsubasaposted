<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_5-1</title>
    </head>
    <body>
        【投稿フォーム】<br>
        <form action="" method="post">
            <input type="text" name="name" placeholder="名前">
            <input type="text" name="com" placeholder="コメント">
            <input type="submit" name="submit">
        </form><br>
            
        【削除フォーム】<br>
         <form action="" method="post">
            <input type="number" name="num" placeholder="削除対象番号">
            <input type="submit" name="del" value="削除">
         </form><br>
        【編集フォーム】<br>
        <form action="" method="post">
            <input type="number" name="editnum" placeholder="編集対象番号">
            <input type="text" name="editname" placeholder="編集後の名前">
            <input type="text" name="editcom" placeholder="編集後のワード">
            <input type="submit" name="edit" value="編集"> 
        </form>
        
        <?php
        $dsn='データベース名';
        $user='ユーザー名';
        $passward='パスワード';
        $pdo=new PDO($dsn,$user,$passward, array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING));

         
    /*コメントが入力されれば入る*/
   if(isset($_POST["com"]) && isset($_POST["name"])) {
    //data input...INSERT tag use.
 $sql= $pdo ->prepare("INSERT INTO tsubasabox(name,comment,date)VALUES(:name,:comment,:date)");
        $sql ->bindParam(':name',$name,PDO::PARAM_STR);
        $sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
        $sql ->bindParam(':date',$date,PDO::PARAM_STR);
     //bindParam...プレースホルダーに値をバインドする。値の参照を受けた後execute()でバインドを確定する。
     //$pdo->prepareで、pdoで接続したDBに対して実行するSQLをセットする。
     $comment=$_POST["com"];
     $name=$_POST["name"];
     $date=date("Y/m/d H:i:s"); /*投稿日時を取得*/
     $sql ->execute();
            }
 //データ抽出...SELECT tag.
     $sql= 'SELECT * FROM tsubasabox';
// * の所にuser_id,nameなど、取得してくる項目名を入力することも可能
$stmt= $pdo->query($sql);
//query...指定したSQL文をDBに届ける。
$results=$stmt->fetchALL();
foreach ($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['date'].'<br>';
    echo "<hr>";
} 
/*削除番号が入力されれば*/
   if(isset($_POST["num"]))
{
//削除対象の入力
$id=$_POST["num"];
$sql='delete from tsubasabox where id=:id';//where句は忘れずに
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
//データ抽出
$sql= 'SELECT * FROM tsubasabox';
// * の所にuser_id,nameなど、取得してくる項目名を入力することも可能
$stmt= $pdo->query($sql);
//query...指定したSQL文をDBに届ける。
$results=$stmt->fetchALL();
foreach ($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['date'].'<br>';
    echo "<hr>";
   }     

} 
/*編集対象番号が入力されれば*/
    if(isset($_POST["editnum"]) && isset($_POST["editname"]) && isset($_POST["editcom"]))
{
    //入力されている文字（レコード）を編集
$id=$_POST["editnum"];
//変更する番号入力
$name=$_POST["editname"];
$comment=$_POST["editcom"];
$date=date("Y/m/d H:i:s");
//変更する文字を入力
$sql = 'UPDATE tsubasabox SET name=:name,comment=:comment,date=:date WHERE id=:id';
//変更の更新...UPDATE tag.
$stmt= $pdo ->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);
$stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
$stmt->bindParam(':date',$date,PDO::PARAM_STR);
$stmt->execute();

//データ抽出
$sql= 'SELECT * FROM tsubasabox';
// * の所にuser_id,nameなど、取得してくる項目名を入力することも可能
$stmt= $pdo->query($sql);
//query...指定したSQL文をDBに届ける。
$results=$stmt->fetchALL();
foreach ($results as $row){
    echo $row['id'].',';
    echo $row['name'].',';
    echo $row['comment'].',';
    echo $row['date'].'<br>';
    echo "<hr>";
    }
}
             
        ?>
    </body>
</html>