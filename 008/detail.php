<?php
include("funcs.php");
$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>配下個別画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="select_board.php">謁見の間</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="select_board.php">一言一覧</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="select.php">配下一覧</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="register.php">配下登録</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>配下</legend>
     <label>名前：<input type="text" name="name" value ="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name="email" value ="<?=$row["email"]?>"></label><br>
     <label>年齢：<input type="text" name="age" value ="<?=$row["age"]?>"></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"><?=$row["naiyou"]?></textArea></label><br>
     <input type="hidden" name="id" value ="<?=$row["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<div><a href="delete.php?id='<?=$row["id"]?>'">[粛清]</a></div>
<!-- Main[End] -->

</body>
</html>