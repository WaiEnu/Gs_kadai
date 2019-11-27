<?php
var_dump($_POST["lid"]);
ini_set("display_errors", 1);
error_reporting(E_ALL);
include("funcs.php");

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
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
$pdo =  db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO sng_user_table(name, lid, lpwd ,kanri_flg ,life_flg ,mao_flg)VALUES(:name,:lid,:lpwd,:kanri_flg,:life_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpwd', $lpwd, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();//実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  redirect("hall.php");
}
?>