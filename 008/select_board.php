<?php
include("funcs.php");

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bo_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .='<div>';
    $view .="<p>".$r["id"]." | ".$r["name"]."</p>";
    $view .="<div><p>".$r["hitokoto"]."</p></div>";
    $view .="<p>".$r["date"]."</p>";
    $view .='<a href="delete_board.php?id='.$r["id"].'">';
    $view .= "[削除]";
    $view .='</a>';
    $view .='</div>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>一言一覧</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="select_board.php">謁見の間</a></div>
      <div class="navbar-header"><span class="navbar-brand" href="select_board.php">一言一覧</span></div>
      <div class="navbar-header"><a class="navbar-brand" href="select.php">配下一覧</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="register.php">配下登録</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>