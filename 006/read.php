<?php
 include("funcs.php");
 include("header.html");
?>
<main>

<h1>結果</h1>
<?php $lines = file(DATA); ?>
<table border="1" style="border-collapse: collapse" >
<tr>
  <th>お名前</th>
  <th>EMAIL</th>
  <th>スコア</th>
  <th>日時</th>
</tr>
<?php
if($lines){
  for($i=0;$i<count($lines);$i++){
    $txts=explode(SEP,$lines[$i]);
?>
<tr>
<?php
    for($j=0;$j<count($txts);$j++){
      echo '<td>'.$txts[$j].'</td>';
    }
?>
</tr>
<?php
  }  
}
?>
</table>

</main>

<?php include("footer.html"); ?>