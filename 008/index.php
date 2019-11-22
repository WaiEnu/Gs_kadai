<?php
include("funcs.php");
//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM sng_question_table ORDER BY score DESC, indate DESC LIMIT 10");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php   
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .='<div>';
      $view .='<div>id：'.$row["id"].'</div>';
      $view .='<div>場所：'.$row["location"].'</div>';
      $view .='<div>日時：'.$row["wdate"].'</div>';
      $view .='<div>詳細：<div>'.$r["naiyou"].'</div></div>';
      $view .='<a href="detail.php?id='.$r["id"].'">"詳細"</a>';
    $view .='</div>';
  }
}

include("template/header.html");
?>
<div class="wrapper">
<div id="deta"><?=$view?></div>
</div>
<?php
include("template/footer.html");
?>