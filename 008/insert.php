<?php
var_dump($_POST["location"]);
ini_set("display_errors", 1);
error_reporting(E_ALL);
include("funcs.php");

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$location = h($_POST["location"]);
$wdate = h($_POST["wdate"]);
$naiyou = h($_POST["naiyou"]);

//2. DB接続します
$pdo =  db_conn();

//３．データ登録SQL作成
//$sql = "INSERT INTO sng_taxsonomy_table(location, wdate, naiyou ,indate)VALUES(:location,:wdate,:naiyou,sysdate())";
$sql = "INSERT INTO sng_question_table(location, wdate, naiyou ,indate)VALUES(:location,:wdate,:naiyou,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':location', $location, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':wdate', $wdate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();//実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  redirect("index.php");
}
?>