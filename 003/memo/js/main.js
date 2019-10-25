"use strict";

var ls = window.localStorage;
const AppName = "MemoAppVer1.";
const temp = new Array(0);
const cnt = 9;

function display() {
  $("#newMemo").val("");
  var s = '<div class="items output">';
  for (var i = 0; i < temp.length; i++) {
    s += '<div class="item"><div class="inner"><p>'
     + temp[i]
     + '</p></div></div>';
  }
  s += "</div>";
  $("#disp").html(s);
}

function addMemo() {
  if (temp.length == cnt) {
    alert("保存できるメモの上限は" + cnt + "件です。");
    $("#newMemo").val("");
    return;
  }
  var v = $("#newMemo").val();
  if (v == "" || v == null) {
    alert("メモが入力されていません。");
    return;
  }
  temp[temp.length] = v;
  display();
}

function save() {
  for (var i = 0; i < 10; i++) {
    if (ls[AppName + "dataId" + i]) {
      ls.removeItem(AppName + "dataId" + i);
    }
  }
  var len = temp.length;
  for (var i = 0; i < len; i++) {
    ls[AppName + "dataId" + i] = temp[i];
  }
  display();
}

function clearAllMemo() {
  var ans = confirm("メモをすべて削除しますか？");
  if (ans) {
    temp.length = 0;
    save();
  }
}

function loadMemo() {
  for (var i = 0; i < 10; i++) {
    if (ls[AppName + "dataId" + i]) {
      temp[i] = ls[AppName + "dataId" + i];
    }
  }
}

function tarot() {
  const tarot = new Array();
  tarot[0] = { no:'0', name:'愚者', mean:'夢想・愚行・極端・熱狂' };
  tarot[1] = { no:'1', name:'魔術師', mean:'意志・手腕・外交' };
  tarot[2] = { no:'2', name:'女教皇', mean:'秘密・神秘・英知' };
  tarot[3] = { no:'3', name:'女帝', mean:'実り・行動・月日の長さ・未知' };
  tarot[4] = { no:'4', name:'皇帝', mean:'統治・堅固さ・防御・同盟' };
  tarot[5] = { no:'5', name:'教皇', mean:'信条・社会性・恵みと有徳' };
  tarot[6] = { no:'6', name:'恋人', mean:'魅力・愛美' };
  tarot[7] = { no:'7', name:'戦車', mean:'援軍・摂理・勝利・復讐' };
  tarot[8] = { no:'8', name:'力', mean:'力・勇気・寛大・名誉' };
  tarot[9] = { no:'9', name:'隠者', mean:'深慮・忠告を受ける・崩壊' };
  tarot[10] = { no:'10', name:'運命の輪', mean:'幸運・転機・向上' };
  tarot[11] = { no:'11', name:'正義', mean:'平等・正しさ・行政・正当な判決' };
  tarot[12] = { no:'12', name:'吊された男', mean:'英知・慎重・試練・直観' };
  tarot[13] = { no:'13', name:'死神', mean:'停止・損失・死と再生' };
  tarot[14] = { no:'14', name:'節制', mean:'調整・中庸・倹約・管理' };
  tarot[15] = { no:'15', name:'悪魔', mean:'暴力・激烈・宿命・黒魔術' };
  tarot[16] = { no:'16', name:'塔', mean:'悲嘆・災難・不名誉・転落' };
  tarot[17] = { no:'17', name:'星', mean:'希望と吉兆・瞑想・霊感・放棄' };
  tarot[18] = { no:'18', name:'月', mean:'隠れた敵・幻想・欺瞞・失敗' };
  tarot[19] = { no:'19', name:'太陽', mean:'物質的な幸福・幸運な結婚・満足' };
  tarot[20] = { no:'20', name:'審判', mean:'復活・位置の変化・更新・結果' };
  tarot[21] = { no:'21', name:'世界', mean:'完成・約束された成功・旅' };

  const card = tarot[Math.floor(Math.random() * tarot.length)];
  return card;
}

function tarotDelete() {
  $("#cardNo").html('<a href="return:false;" onclick="tarotReading()">◯タロット</a>');
}

function tarotReading() {

  const card = tarot();
  const tarotTable
   = '<h3>◯タロット</h3>'
   + '<table><tr><th>番号</th><td>' + card.no + '</td></tr>'
   + '<tr><th>タイトル</th><td>' + card.name + '</td></tr>'
   + '<tr><th>意味</th><td>' + card.mean  + '</td></tr></table>'
   + '<a href="return:false;" onclick="tarotReading()">ReLoad</a>'
   + '<a href="return:false;" onclick="tarotDelete()">Delete</a>';

  $("#cardNo").html(tarotTable);
}

function load() {
  loadMemo();
  display();
}

$(document).ready(function() {
  load();

  $(".item").draggable();
});