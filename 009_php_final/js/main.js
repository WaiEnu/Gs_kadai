
//登録ボタンをクリック
$("#btn").on("click",function() {
  validate();
  //Ajax送信開始
  $.ajax({
    type: "POST",     //POST or GET
    url: "result.php", //どこに送信？
    data: {            //送信データ
      time: $time.val(),
      initial: $initial.val(),
      growth_rate: $growth_rate.val(),
      capacity: $capacity.val()
    },
    dataType: "json",         //戻ってくるデータの型を指定
    success: function(data) { //通信成功時にsuccess内が実行される！
      drowGraph(data);
    },
    error: function(error) {
      alert("通信エラー");
      console.log("ajax通信に失敗しました");
      console.log("XMLHttpRequest : " + XMLHttpRequest.status);
      console.log("errorThrown    : " + error.message);
    },
  });
});

$("#init").on("click",function() {
  init();
});

$("#resset").on("click",function() {
  resset();
});

$(function(){
  init();
  resset();
});