<?php
include("template/funcs.php");

$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$stmt = $pdo->prepare("SELECT * FROM sng_question_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include("template/header.html");
?>
<!-- Main[Start] -->
<section>
  <article>
    <div id="input">
      <form method="POST" action="update.php">
        <div class="jumbotron">
          <div>id：<?=$row["id"]?></div>
          <div>場所：<?=$row["location"]?></div>
          <div>日時：<?=$row["wdate"]?></div>
          <div>詳細：<div ><?=$row["naiyou"]?></div></div>
          <?php
            $knr_flg=1;
            if($knr_flg===1&&$row["hensin"]===""){
          ?>
          <fieldset>
            <label for="hensin"><input type="text" name="hensin"><?=$row["hensin"]?></label>
            <input type="hidden" name="id" value ="<?=$row["id"]?>">
            <input type="submit" value="送信">
          </fieldset>
          <div><a href="delete.php?id='<?=$r["id"]?>'">[削除]</a></div>
          <?php
            }else{
          ?>
          <div><?=$row["hensin"]?></div>
          <?php
            }
          ?>
        </div>
      </form>
    </div>
  </article>
</section>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>