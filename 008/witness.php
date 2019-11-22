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
      <form method="POST" action="insert.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="location">場所：<input type="text" name="location"></label></div>
            <div><label for="wdate">日時:<input type="text" name="wdate"></label></div>
            <div><label for="naiyou">詳細：<input type="text" name="naiyou"></label></div>
            <div><input type="submit" value="送信"></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>