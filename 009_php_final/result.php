<?php
function row_malthus($y0,$k,$t){
  $arr = [];
  for($i=0;$i<$t+1;$i++){
    $tmp = ['time'=>$i,'rate'=>malthus($y0,$k,$i)];
    $arr[] = $tmp;
  }
  return $arr;
}
function malthus($y0,$k,$t){
  $y=$y0*exp($k*$t);
  return $y;
}
function row_logistic($y0,$l,$k,$t){
  $arr = [];
  for($i=0;$i<$t+1;$i++){
    $tmp = ['time'=>$i,'rate'=>logistic($y0,$l,$k,$i)];
    $arr[] = $tmp;
  }
  return $arr;
}
function logistic($y0,$l,$k,$t){
  $a=($l-$y0)/$y0;
  $y=$l/(1+$a*exp(-$k*$t));
  return $y;
}
function row_fib($t){
  $arr = [];
  for($i=0;$i<$t+1;$i++){
    $tmp = ['time'=>$i,'rate'=>fib($i)];
    $arr[] = $tmp;
  }
  return $arr;
}
function fib($n){
  return floor( pow((1+sqrt(5))/2, $n) / sqrt(5) + 1/2 );
}
$t = $_POST['time'];
$y0 = $_POST['initial'];
$k = $_POST['growth_rate'];
$l = $_POST['capacity'];

$value_array = ['マルサスモデル'=>row_malthus($y0,$k,$t),'ロジスティック関数'=>row_logistic($y0,$l,$k,$t),'フィボナッチ数'=>row_fib($t)];

$jsonstr =  json_encode($value_array);
 
echo $jsonstr;
?>