<?php
include("funcs.php");

//1. POSTデータ取得
$id = $_POST["id"];
/**
$class = h($_POST["class"]);
$order = h($_POST["order"]);
$family = h($_POST["family"]);
$genus = h($_POST["genus"]);
$species = h($_POST["species"]);
**/

//2. DB接続します
$pdo = db_conn();

//３．データ更新SQL作成
//$sql = "UPDATE sng_taxsonomy_table SET class=:class, order=:order, family=:family, genus=:genus, species=:species, indate=sysdate() WHERE id=:id";
$sql = "UPDATE sng_question_table SET henshin=:henshin, indate=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
/**
$stmt->bindValue(':class', $class, PDO::PARAM_STR);
$stmt->bindValue(':order', $order, PDO::PARAM_STR);
$stmt->bindValue(':family', $family, PDO::PARAM_STR);
$stmt->bindValue(':genus', $genus, PDO::PARAM_STR);
$stmt->bindValue(':species', $species, PDO::PARAM_STR);
**/
$stmt->bindValue(':henshin', $henshin, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("index.php");
}

?>