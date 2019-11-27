<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <title>魔王の間</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<header>
    <?php
      if($_SESSION["life_flg"] === 0 ){
    ?>
  <ul>
    <li><a href="hall.php">魔王の間</a></li>
    <li><a href="select_user.php">配下一覧</a></li>
    <li><a class="navbar-brand" href="logout.php">ログアウト</a></li>
  </ul>
    <?php
    }else{
    ?>
    <nav class="navbar navbar-default">LOGIN</nav>
    <?php
    }
    ?>
</header>

<main>