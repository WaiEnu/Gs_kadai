<?php
include("template/funcs.php");

//1. POSTデータ取得
$id = $_POST["id"];
$hensin = $_POST["hensin"];

//2. DB接続します
$pdo = db_conn();

//３．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE sng_question_table SET hensin=:hensin, indate=sysdate() WHERE id=:id");
$stmt->bindValue(':hensin', $hensin, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("index.php");
}

?>