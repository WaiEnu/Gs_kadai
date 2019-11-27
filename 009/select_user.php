<?php
include("funcs.php");
//1.  DB接続します
$pdo =  db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM sng_user_table WHERE life_flg = 0 AND mao_flg = 0 ORDER BY id DESC";
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
    if($r["kanri_flg"]==="1"){
      $view .='<p>[管理者]</p>';
    }else{
      $view .='<p>[一般]</p>';
    }
    if($_SESSION["kanri_flg"]==="1"){
      $view .='<p><a href="detail_user.php?id='.$r["id"].'">[編集]</a>　';
    }
    if($_SESSION["mao_flg"]==="1"){
      $view .='<a href="delete_user.php?id='.$r["id"].'">[粛清]</a></p>';
    }
    $view .='</div><!--.postText-->';
  }
}

$flg = session_start();

include("template/header.php");
?>
<section>
  <article>
<?php
$options ='';
var_dump($_SESSION["mao_flg"]);
if($_SESSION["mao_flg"]==="1"){
?>
    <div id="input">
      <a href="register_user.php">配下登録</a>
    </div>
<?php
}else{
?>
<div class="postText">
  <h3><a href="detail_mao.php">[魔王]</a></h3>
</div><!--.postText-->
<?php
}
?>
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