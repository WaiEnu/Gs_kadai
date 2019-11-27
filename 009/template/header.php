<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <title>Your Witness</title>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<header>
  <ul>
    <li><a href="index.php">目撃情報</a></li>
    <li><a href="login.php">ログイン</a></li>
    <?php
      $knr_flg=$_SESSION["kanri_flg"];
      if($knr_flg===1){
    ?>
    <li><a href="select_user.php">ユーザー一覧</a></li>
    <li><a class="navbar-brand" href="logout.php">ログアウト</a></li>
    <?php
    }
    ?>
  </ul>
</header>

<main>