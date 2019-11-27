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
      if($_SESSION["name"]){
    ?>
  <ul>
    <li><a href="hall.php">魔王の間</a></li>
    <li><a class="navbar-brand" href="logout.php">ログアウト</a></li>
    <?php
      if($_SESSION["kanri_flg"]===1){
    ?>
    <li><a href="select_user.php">配下一覧</a></li>
    <?php
    }
    ?>
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