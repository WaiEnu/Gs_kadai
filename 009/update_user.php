<?php
include("funcs.php");

//1. POSTデータ取得
$name = h($_POST["name"]);
$lid = h($_POST["lid"]);
$lpwd = h($_POST["lpwd"]);
$user_options = h($_POST["user_options"]);
$kanri_flg = null;
$life_flg = 0;
if($user_options===1){
  $kanri_flg = 1;
}else{
  $kanri_flg = 0;
}

//2. DB接続します
$pdo = db_conn();

//３．データ更新SQL作成
$sql = "UPDATE sng_user_table SET name=:name, lid=:lid, lpwd=:lpwd, kanri_flg=0, life_flg=1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpwd', $lpwd, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();//実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("hall.php");
}

?>