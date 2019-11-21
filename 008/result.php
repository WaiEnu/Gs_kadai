<?php
include("funcs.php");

//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM sng_score_table ORDER BY score DESC, indate DESC LIMIT 10");
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
  $json=json_encode($result , JSON_UNESCAPED_UNICODE);
}

 include("template/header.html");
?>

<div id="deta">
  <div id= "avarage"></div>
  <div id= "graph"></div>
  <div id= "result"></div>
</div>

<?php include("template/d3js.html"); ?>
<?php include("template/footer.html"); ?>