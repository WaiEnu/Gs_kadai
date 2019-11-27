<?php
include("funcs.php");
//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM sng_question_table ORDER BY indate DESC";
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
      $view .='<h3><span>name：</span>'.$r["name"].'</h3>';
      $view .='<p><span>date：</span>'.$r["indate"].'</p>';
      $view .='<div class="message">';
        $view .='<div>'.$r["naiyou"].'</div>';
      $view .='</div><!--.message-->';
    if($_SESSION["mao_flg"]===1){
      $view .='<p><a href="delete.php?id='.$r["id"].'">[粛清]</a></p>';
    }
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
            <div><label for="name">名前：<input type="text" name="name" value="<?=$_SESSION["name"]?>"></label></div>
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