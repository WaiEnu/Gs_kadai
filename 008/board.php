<?php
$name=$GET["name"];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>謁見の間</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><span class="navbar-brand" href="select_board.php">名前: <?=$name?></span></div>
      <div class="navbar-header"><span class="navbar-brand" href="select_board.php">謁見の間</span></div>
      <div class="navbar-header"><a class="navbar-brand" href="select_board.php">一言一覧</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="select.php">配下一覧</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="register.php">配下登録</a></div>
      <div class="navbar-header"><span class="navbar-brand" href="mao.php">魔王の間</span></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<h1>謁見の間</h1>
<form method="POST" action="insert_board.php">
  <div class="jumbotron">
   <fieldset>
     <label>名前：<input type="text" name="name" value="<?=$name?>"></label><br>
     <label>自己PR：<textArea name="hitokoto" rows="4" cols="40"></textArea></label>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>