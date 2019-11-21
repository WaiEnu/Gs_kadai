<?php
include("funcs.php");

//1. POSTデータ取得
$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$naiyou = $_POST["naiyou"];
$age = $_POST["age"];

//2. DB接続します
$pdo = db_conn();

//３．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE gs_an_table SET name=:name, email=:email, age=:age, naiyou=:naiyou, indate=sysdate() WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}

?>