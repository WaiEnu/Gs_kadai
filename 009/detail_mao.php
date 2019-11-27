<?php
include("funcs.php");

$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$sql = "SELECT * FROM sng_user_table WHERE mao_flg = 1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include("template/header.php");
?>
<!-- Main[Start] -->
<section>
  <article>
    <div id="input">
        <div class="jumbotron">
          <div><p>名前：<?=$row["name"]?></p></div>
          <div><p>ID：<?=$row["lid"]?></p></div>
          <div><p>[魔王]</p></div>
        </div>
    </div>
  </article>
</section>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>