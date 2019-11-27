<?php
include("funcs.php");

$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$sql = "SELECT * FROM sng_user_table WHERE id = :id";
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
      <form method="POST" action="update_user.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="henshin">返信：</label></div>
            <div><label for="name">名前：<input type="text" name="id" value ="<?=$row["id"]?>"></label></div>
            <div><label for="lid">ID：<input type="text" name="lid" value ="<?=$row["lid"]?>"></label></div>
            <div><label for="lpwd">PASS：<input type="text" name="lpwd" value ="<?=$row["lpwd"]?>"></label></div>
            <div><label for="kanri_flg">管理フラグ：<input type="text" name="kanri_flg" value ="<?=$row["kanri_flg"]?>"></label></div>
            <div><label for="life_flg">状態フラグ：<input type="text" name="life_flg" value ="<?=$row["life_flg"]?>"></label></div>
            <input type="hidden" name="id" value ="<?=$row["id"]?>">
            <div><input type="submit" value="送信" ></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>