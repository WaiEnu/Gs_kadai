"use strict";

//var chatDataStore = new Firebase('https://chant-d009a.firebaseio.com');
var db = firebase.firestore();

const send = "send";
const hasReply = "00000";
const hasNoReply = "";
const site = "#boad .output";

const input_name = '<div class="name"><label for="username">名前:<input type="text" id="username" class="input"></label></div>';
const input_button = '<div class="btn"><button class="submit" id="send">送信</button></div>';
function input_button_ctrl(key){
  const input_button_ctrl = '<div class="btn"><button class="submit" id="' + key + '">送信</button></div>';
  return input_button_ctrl; 
} 
const input_select = '<div class="select"><select name="example" id="type"><option value="1">image1</option><option value="2">image2</option><option value="3">image3</option></select></div>';
const input_text = '<textarea name="" id="text" rows="5" class="input"></textarea>';
function input_ctrl(key) {
  const input_ctrl = '<div class="input_ctrl" id="div_' + key + '" >返信</div><div class="form"></div><div class="output"></div>';
  return input_ctrl;
}
function getDate() {
  var dt = new Date();
  var year = dt.getFullYear(); //年
  var month = dt.getMonth() + 1; //月・・・1月が0、12月が11。そのため+1をする。
  var date = dt.getDate(); //日
  var hours = dt.getHours(); //時
  var minutes = dt.getMinutes(); //分
  var seconds = dt.getSeconds(); //秒
  const time = year + "年" + month + "月" + date + "日 " + hours + ":" + minutes + ":" + seconds;
  return time;
}
function postText(dataVal, date) {
  const out = "<h3><span>key : </span>" +dataVal.key + "</h3>" 
   + '<h3><span class="icon ' + dataVal.image + '"><span>name : </span>' + dataVal.username + "</span></h3>" 
   + '<div class="message">' + dataVal.text + "</div>"
   + "<p><span>date : </span>" + date +"</p>";
  return out;
}
function inputpostTextInit() {
  const postText = "<form>"
   + input_name
   + input_select
   + '<div id="inputStyle">'
   + input_text
   + "</div>"
   + input_button
   + "</form>";
  return postText;
}
function inputpostText(key) {
  const postText = "<form>"
   + input_name
   + input_select
   + '<div id="inputStyle">'
   + input_text
   + "</div>"
   + input_button_ctrl(key)
   + "</form>";
  return postText;
}

function Output(dataKey, dataVal, date) {
  let node = dataVal.node;
  if (node === hasNoReply) {
    OutputFirst(dataKey, dataVal, date);
  } else if (node === hasReply) {
    OutputNode(dataKey, dataVal, date);
  } else {
    OutputChild(dataKey, dataVal, date);
  }
  $("#boad .postText.noReply .output").html("");
}
function OutputFirst(dataKey, dataVal, date) {
  const hash = {key: dataKey, username: dataVal.username, text: dataVal.text, image: dataVal.image};
  const post = '<div class="postText noReply" id="id_' + hash.key + '">'
   + postText(hash, date)
   + input_ctrl(hash.key)
   + "</div>";
  $(site).append(post);
  inputCtrlClicked('#div_'+hash.key);
}
function OutputNode(dataKey, dataVal, date) {
  const hash = {key: dataKey, username: dataVal.username, text: dataVal.text, image: dataVal.image};
  const post = '<div class="postText" id="id_' + hash.key + '">'
   + postText(hash, date)
   + input_ctrl(dataVal.key)
   + "</div>";
  $(site).append(post);
}
function OutputChild(dataKey, dataVal, date) {
  const site = "#id_" + dataVal.node;
  const hash = { key: dataKey, username: dataVal.username, text: dataVal.text };
  const post = '<div class="postText" id="id_' + hash.key + '">'
   + postText(dataVal, date)
   + "</div>";
  $(site).append(post);
}

function inputCtrlClicked(key) {
  $(key).on("click", function() {
    console.log("clicked:inputCtrlClicked"+key);
    $(key).next(".form").html(inputpostText(key.replace('div','node')));
    $(key).html('');
    bindReply(key);
  });
}
function bindReply(key) {
  console.log("clicked:sendReplyMsg"+key);
  $(key).next(".form").find(".submit").on("click", function(e) {
    e.preventDefault();
    console.log("clicked:sendReplyMsg-c"+key);
    sendMsg(key);
  });
  $(key).next(".form").find("#text").on("keydown", function(e) {
    console.log("clicked:sendReplyMsg-kd"+key);
    if (e.keyCode == 13) { sendMsg(key); }
  });
}
function sendReplyMsg(key) {
  sendMsg(key);
  sendReplyFormClear(key);
}
function sendReplyFormClear(key) {
  $(key).next(".form").html('');
  $(key).html(input_ctrl(key));
}

function sendMsg(key) {
  //送信
  if ($("#text").val() == "") {
    return;
  }

  let image_src = "";
  if ($("#type").val() === "1") {
    image_src = "image1";
  } else if ($("#type").val() === "2") {
    image_src = "image2";
  } else if ($("#type").val() === "3") {
    image_src = "image3";
  }

  let node_str = '';
  if (key === send) { node_str = hasNoReply; }
  else{ node_str = key; }
  let name_str = $("#username").val();
  let text_str = $("#text").val();

  const post = {node:node_str, username:name_str, text:text_str, image:image_src};

  //データベースの中の「talks」に値を送り格納（'talks'は各自任意に設定可能）
  //firestoreの.add()で追加(id自動生成)
    console.log('snapshot')
  db.collection("talks").add(post);
  $(".input").val("");
}
function recieveMsg() {
  //受信
  db.collection("talks").onSnapshot(function(snapshot) {
    snapshot.docChanges().forEach(function(change) {
      if (change.type === "added") {
        const dataVal = change.doc.data(); //データ取得
        const dataKey = change.doc.id; //自動生成されたID取得
        const date = getDate(); //日付取得
        Output(dataKey, dataVal, date);
      }
      if (change.type === "removed") {
        //console.log(`removed doc ${change.doc}`);
      }
    });
  });
}
function bind() {
  //送信
  $(".submit").on("click", function(e) {
    e.preventDefault();
    var key = $(this).attr("id");
    sendMsg(key);
  });
  //ENTERKEY
  $("#text").on("keydown", function(e) {
    var key = $(this).attr("id");
    if (e.keyCode == 13) { sendMsg(key); }
  });
}

$("#input").html(inputpostTextInit());
$(function () {
  bind();
  recieveMsg();
});