<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>配下登録</title>
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
      <div class="navbar-header"><span class="navbar-brand">配下登録</span></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>配下登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>Email：<input type="text" name="email"></label><br>
     <label>年齢：<input type="text" name="age"></label><br>
     <label>自己PR：<textArea name="naiyou" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>