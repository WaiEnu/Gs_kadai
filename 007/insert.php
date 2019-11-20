<?php
include("funcs.php");

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = h($_POST["name"]);
$email = h($_POST["email"]);
$naiyou = h($_POST["score"]);

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  //$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
  //本番環境
  $pdo = new PDO('mysql:dbname=waienu5_lab8;charset=utf8;host=waienu5.sakura.ne.jp','waienu5','root2root');
} catch (PDOException $e) {
  exit('DB ERROR:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO sng_deta_table(name,email,score,indate)VALUES(:name,:email,:score,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':score', $naiyou, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();//実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("DB ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: result.php");
  exit();
}
?>