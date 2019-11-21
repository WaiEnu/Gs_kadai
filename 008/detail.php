<?php
include("funcs.php");

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
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name="name" value ="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name="email" value ="<?=$row["email"]?>"></label><br>
     <label>年齢：<input type="text" name="age" value ="<?=$row["age"]?>"></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"><?=$row["naiyou"]?></textArea></label><br>
     <input type="hidden" name="id" value ="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>