<?php
include("funcs.php");
//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM sng_user_table WHERE mao_flg = 0 ORDER BY id DESC";
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
      $view .='<p><span>名前：</span>'.$r["name"].'</p>';
      $view .='<p><span>ID：</span>'.$r["lid"].'</p>';
      $view .='<p><span>PASS：</span>******</p>';
      $view .='<p><span>管理フラグ：</span>'.$r["kanri_flg"].'</p>';
      $view .='<p><span>状態フラグ：</span>'.$r["life_flg"].'</p>';
      $view .='<p><span>詳細：</span>'.$r["location"].'</p>';
      $view .='<p><a href="detail_user.php?id='.$r["id"].'">[編集]</a>　';
      if($_SESSION["mao_flg"]===1){
        $view .='<a href="delete_user.php?id='.$r["id"].'">[粛清]</a></p>';
      }
    $view .='</div><!--.postText-->';
  }
}

include("template/header.php");
?>
<section>
  <article>
    <div id="input">
      <form method="POST" action="insert_user.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="name">名前：<input type="text" name="id" value ="<?=$row["id"]?>"></label></div>
            <div><label for="lid">ID：<input type="text" name="lid" value ="<?=$row["lid"]?>"></label></div>
            <div><label for="lpwd">PASS：<input type="text" name="lpwd" value ="<?=$row["lpwd"]?>"></label></div>
            <div><label for="kanri_flg">管理フラグ：<input type="text" name="kanri_flg" value ="<?=$row["kanri_flg"]?>"></label></div>
            <div><label for="life_flg">状態フラグ：<input type="text" name="life_flg" value ="<?=$row["life_flg"]?>"></label></div>
            <div><input type="submit" value="送信" ></div>
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