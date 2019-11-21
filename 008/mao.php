<?php
include("funcs.php");
$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_mo_table WHERE id = :id");
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
  <title>魔王</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="board.php">謁見の間</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="jumbotron">
  <div>魔王</div>
  <div>名前：<?=$row["name"]?></div>
  <div>Email：<?=$row["email"]?></div>
  <div>年齢：<?=$row["age"]?></div>
  <div><?=$row["naiyou"]?></div>
  <div><a href="detail_mao.php">編集</a></div>
</div>

<div class="jumbotron">
  <div><a href="select_board.php">一言一覧</a></div>
  <div><a href="select.php">配下一覧</a></div>
  <div><a href="register.php">配下登録</a></div>
</div>
<!-- Main[End] -->

</body>
</html>