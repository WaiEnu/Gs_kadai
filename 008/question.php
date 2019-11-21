<?php
 include("funcs.php");

 //1.  DB接続します
 $pdo =  db_conn();
 
 //２．データ登録SQL作成
 $stmt = $pdo->prepare("SELECT * FROM sng_question_table ORDER BY id ASC");
 $status = $stmt->execute();
 
 //３．データ表示
 $view="";
 if($status==false) {
   //execute（SQL実行時にエラーがある場合）
   sql_error($stmt);
 
 }else{
   //Selectデータの数だけ自動でループしてくれる
   //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php   
   while( $result[] = $stmt->fetch(PDO::FETCH_ASSOC));
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .='<p>';
    $view .='<a href="detail.php?id='.$r["id"].'">';
    $view .= "問題".$r["id"];
    $view .='</a>　';
    $view .='<a href="delete.php?id='.$r["id"].'">';
    $view .= "[削除]";
    $view .='</a>';
    $view .='</p>';
  }
 }
 
 include("template/header.html");
?>

<div id="deta">
  <div id= "avarage"></div>
  <div id= "graph"></div>
  <div id= "result"></div>
</div>

<?php include("template/footer.html"); ?>