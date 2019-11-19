<?php
include("funcs.php");

$name=h($_POST["name"]);
$mail=h($_POST["mail"]);
$score=h($_POST["score"]);
//文字作成
$str = date("Y-m-d H:i:s");
//File書き込み
$file = fopen(DATA,"a");	// ファイル読み込み
fwrite($file, $name.SEP.$mail.SEP.$score.SEP.$str."\n");
fclose($file);

include("header.html");
?>
<main>

<h1>書き込みしました。</h1>
<h2>./data/data.txt を確認しましょう！</h2>

</main>

<ul>
  <li><a href="read.php">結果</a></li>
</ul>

<?php include("footer.html"); ?>