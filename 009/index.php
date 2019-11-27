<?php
include("funcs.php");
//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM sng_question_table ORDER BY wdate DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);

}else{
  $view ='';
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php   
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .='<div class="postText">';
      $view .='<h3>id：'.$r["id"].'</h3>';
      $view .='<p><span>日時：</span>'.$r["wdate"].'</p>';
      $view .='<p><span>場所：</span>'.$r["location"].'</p>';
      $view .='<p><span>詳細：</span></p>';
      $view .='<div class="message">';
        $view .='<div>'.$r["naiyou"].'</div>';
      $view .='</div><!--.message-->';
    if($r["henshin"]){ 
      $view .='<p><span>返信：</span></p>';
      $view .='<div class="message">';
        $view .='<div>'.$r["henshin"].'</div>';
      $view .='</div><!--.message-->';
    }
      $view .='<p><a href="detail.php?id='.$r["id"].'">[編集]</a></p>';
    $view .='</div><!--.postText-->';
  }
}

include("template/header.php");
?>
<section>
  <article>
    <div id="input">
      <form method="POST" action="insert.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="wdate">日時：<input type="date" name="wdate" value="2019-10-08" min="2019-10-08" max="2119-10-08"></label></div>
            <div><label for="location">場所：<input type="text" name="location"></label></div>
            <div><label for="naiyou">詳細：</label></div>
            <div><textarea type="text" rows="3" name="naiyou" ></textarea></div>
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