<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
  return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続： db_conn()
function db_conn(){
  try {
    //Password:MAMP='root',XAMPP=''
    //$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
    //本番環境
    $pdo = new PDO('mysql:dbname=waienu5_lab8;charset=utf8;host=mysql743.db.sakura.ne.jp','waienu5','root2root');
  } catch (PDOException $e) {
    exit('DB Connection Error'.$e->getMessage());
  }
  return $pdo;
}

//SQLエラー: sql_error($stmt)
function sql_error($stmt){
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//リダイレクト: redirect($file_name)
function redirect($file_name){
  header("Location: ".$file_name);
  exit();
}


?>