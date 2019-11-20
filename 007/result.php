<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  //$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
  //本番環境
  $pdo = new PDO('mysql:dbname=waienu5_lab8;charset=utf8;host=waienu5.sakura.ne.jp/','waienu5','root2root');
} catch (PDOException $e) {
  exit('DB Connection Error'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM sng_deta_table ORDER BY score DESC, indate DESC");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("DB Connection Error:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php 
  $view .= "<table>";
  /**while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr><td>".$result["id"]."</td><td>".$result["name"]."</td><td>".$result["naiyou"]."</td></tr>"; 
  }
  $view .= "</table>";*/
  while( $result[] = $stmt->fetch(PDO::FETCH_ASSOC));
  $json=json_encode($result , JSON_UNESCAPED_UNICODE);
}
?>
<?php
 include("funcs.php");
 include("template/header.html");
?>

<div id="deta">
  <div id= "avarage"></div>
  <div id= "graph"></div>
  <div id= "result"></div>
</div>

<?php include("template/d3js.html"); ?>
<?php include("template/footer.html"); ?>