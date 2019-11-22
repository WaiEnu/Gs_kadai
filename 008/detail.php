<?php
include("funcs.php");

$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$sql = "SELECT * FROM sng_question_table WHERE id = :id";
$stmt = $pdo->prepare($sql);
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
            $knr_flg=0;
            $disabled='';
            if($knr_flg===0){
              $disabled='disabled="disabled"';
            }
          ?>
          <fieldset>
            <div><label for="hensin">返信：</label></div>
            <div><textarea type="text" name="hensin" <?=$disabled?>><?=$row["hensin"]?></textarea></div>
            <input type="hidden" name="id" value ="<?=$row["id"]?>">
            <div><input type="submit" value="送信" <?=$disabled?>></div>
          </fieldset>
          <div><a href="delete.php?id='<?=$r["id"]?>'">[削除]</a></div>
        </div>
      </form>
    </div>
  </article>
</section>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>