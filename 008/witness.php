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
<form method="POST" action="insert.php">
  <div class="jumbotron">
    <fieldset>
     <label for="location"><input type="text" name="location"></label>
     <label for="wdate"><input type="text" name="wdate"></label>
     <label for="naiyou"><input type="text" name="naiyou"></label>
     <label for="hensin"><input type="text" name="hensin"></label>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>