<?php
include("funcs.php");
//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM sng_question_table ORDER BY wdate DESC");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);

}else{
  $view ='<div class="postText">NoPost</div><!--.postText-->';
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php   
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view ='<div class="postText">';
      $view .='<h3>id：'.$row["id"].'</h3>';
      $view .='<h3>日時：'.$row["wdate"].'</h3>';
      $view .='<h3>場所：'.$row["location"].'</h3>';
      $view .='<div class="message">';
        $view .='<h3>詳細：'.$row["wdate"].'</h3>';
        $view .='<div>'.$r["naiyou"].'</div>';
      $view .='</div><!--.message-->';
      $view .='<div class="input_ctrl">';
        $view .='<a href="detail.php?id='.$r["id"].'">"編集"</a>';
      $view .='</div><!--.input_ctrl-->';
    $view .='</div><!--.postText-->';
  }
}

include("template/header.html");
?>
<section>
  <article>
    <div id="input">
      <form method="POST" action="insert.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="location">場所：<input type="text" name="location"></label></div>
            <div><label for="wdate">日時:<input type="date" name="wdate" value="2019-10-08" min="2019-10-08" max="2119-10-08"></label></div>
            <div><label for="naiyou">詳細：<input type="text" name="naiyou"></label></div>
            <div><input type="submit" value="送信"></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>
<section id="boad" class="output_wrapper">
  <article>
    <div class="output">
      <?=$view?>
    </div>
  </article>
</section>
<?php
include("template/footer.html");
?>