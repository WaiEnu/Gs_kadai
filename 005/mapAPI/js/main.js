"use strict";

const localStrage_key = "position";
const $geocode = $("#geocode");
const $send = $("#send");
const $input = $(".input");
const $select = $("#select");
const $main = $("main");
const $allClear = $("#allClear");
const $clear = $(".clear");
const $modal = $(".js-modal");
const $type_submit = $("#type_submit");
const $type_select = $("#type_select");
const $type_title = $("#type_title");

$(function() {
  $send.on("click", function() {
    $input.val("");
    if ($select.val() === "宇宙人") {
      localStorage.removeItem(localStrage_key);
      setTimeout(function(){
        $main.html('<div class="forbidden"><h1>あなたは連行されます</h1></div>');
      },1000);
    }
    return false;
  });
});

function GetMap() {
  //0. Map初期化
  const map = new Bmap("#myMap");

  const actions =
  [
    {//1.action
        label: 'delete',
        eventHandler: function () { //function
            alert('delete');
        }
    },
    {//2.action
        label: 'edit',
        eventHandler: function () { //function
            alert('edit');
        }
    }
  ];

  let pos = [];
  //1. Map表示
  map.startMap(47.6149, -122.1941, "load", 10);
  const positions = JSON.parse(localStorage.getItem(localStrage_key));

  setLocation(positions);

  //2.Get geocode of click location
  map.onGeocode("click", function(clickPoint) {
    const latitude = clickPoint.location.latitude;
    const longitude = clickPoint.location.longitude;
    var uuid = getUniqueStr();
      map.reverseGeocode(clickPoint.location, function(data) {
        console.log(data);
        const pos_tmp = { id: uuid, title: 'undefined', lat: latitude, lon: longitude, info: data };
        /**
        let description = setDiscription(pos_tmp);
        map.infobox(pos_tmp.lat, pos_tmp.lon, pos_tmp.data, description);
        let pin = map.pin(pos_tmp.lat, pos_tmp.lon, "#ff0000");
        */
        setPosition(pos_tmp);
        appendLocation(pos_tmp);
        pos.push(pos_tmp);
        localStorage.setItem(localStrage_key, JSON.stringify(pos));
      });
  });
  function setPosition(pos) {
    let description = setDiscription(pos);
    map.onInfobox(pos.lat, pos.lon, pos.title, description,actions);
    let pin = map.pin(pos.lat, pos.lon, "#ff0000");
  }
  function appendLocation(pos) {
    let listItem = getListItem(pos);
    $geocode.append(listItem);
  }
  function setLocation(positions) {
    if (positions) {
      for (var i = 0; i < positions.length; i++) {
        const pos = positions[i];
        setPosition(pos);
      }
    }
    setLocationList(positions);
    allClear();
  }
  function setLocationList(positions) {
    let list = "";
    if (positions) {
      for (var i = 0; i < positions.length; i++) {
        const pos = positions[i];
        let listItem = getListItem(pos);
        list += listItem;
      }
    }
    $geocode.html(list);
  }
  function getListItem(pos) {
    let listItem =  '<ul class="UMA_infomation_list" id="' + pos.id + '" style="list-style:none;">'
     + "<li><span>id:</span><span>" + pos.id + "</span></li>"
     + "<li><span>title:</span><span>" + pos.title + "</span></li>"
     + "<li><span>location:</span><span>" + pos.info + "</span></li>"
     + "<li><span>latitude:</span><span>" + pos.lat + "</span></li>"
     + "<li><span>longitude:</span><span>" + pos.lon + "</span></li>"
     + "</ul>";
    return listItem;
  }
  function setDiscription(pos) {
    let description = "title: " + pos.title + "<br>"
     +  "id: " + pos.id + "<br>"
     + "latitude:" + round(pos.lat) + "<br>"
     + "longitude:" + round(pos.lon);
    return description;
  }
  function allClear() {
    $allClear.on("click", function() {
      localStorage.removeItem(localStrage_key);
      map.deletePin();
      location.reload();
    });
  }
}

function round(num) {
  const n = 3; // 小数点第n位まで残す
  return Math.floor(num * Math.pow(10, n)) / Math.pow(10, n);
}
function getUniqueStr(myStrong) {
  var strong = 1000;
  if (myStrong) strong = myStrong;
  return (
    new Date().getTime().toString(16) +
    Math.floor(strong * Math.random()).toString(16)
  );
}
