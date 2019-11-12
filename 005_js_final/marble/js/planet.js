const epsilon = 1.0e-14;
var times = 0;
var degree = 0; //中心点からの角度
var drawRadius = 10; //動かしたい円の半径
var ex = []; // ellipse
var ey = [];
var time = 0;
var time2 = 0;

onload = function() {
  planet();

  planet_hz();
};

function planet_hz() {
  var cvs_hz = document.getElementById("planet_hz_disp");
  ctx_hz = cvs_hz.getContext("2d");
  cv_hz_width = cvs_hz.width;
  cv_hz_height = cvs_hz.height;
  cx_hz = cv_hz_width / 2;
  cy_hz = cv_hz_height / 2;

  ctx_hz.clearRect(0, 0, cv_hz_width, cv_hz_height);

  const arr_hbzArea = JSON.parse(localStorage.getItem(hbzArea));
  var imageSrcs = [
    { key: "freeze", src: "./img/burning.gif" },
    { key: "burn", src: "./img/freezing.gif" },
    { key: "habitat", src: "./img/kitten.gif" }
  ];
  var planetImg = [];
  for (var i in imageSrcs) {
    planetImg[i] = new Image();
    planetImg[i].src = imageSrcs[i].src;
  }
  var loadedCount = 1;
  for (var i in planetImg) {
    console.log(arr_hbzArea[imageSrcs[i].key])
    planetImg[i].addEventListener(
      "load",
      function() {
        if (loadedCount == planetImg.length) {
          for (var j in planetImg) {
            var smj_rad=arr_hbzArea[imageSrcs[j].key];
            var rad = radians(degree);
            var x = Math.cos(rad) * smj_rad;
            var y = Math.sin(rad) * smj_rad;
            ctx_hz.drawImage(planetImg[j], cx_hz + x, cy_hz + y);
            console.log(cx_hz, cy_hz, x, y, smj_rad, rad, planetImg[j])
          }
        }
        loadedCount++;
      },
      false
    );
  }

  degree = (degree + 2) % 360;

  //setTimeout(planet_hz, 1000 / 30);
}

function planet() {
  const arr_moveOrbit = JSON.parse(localStorage.getItem(moveOrbit));

  let smj_rad = arr_moveOrbit.smj_rad;
  let smn_rad = arr_moveOrbit.smn_rad;
  let focus_dis = arr_moveOrbit.focus_dis;

  var canvas = document.getElementById("planet_disp");
  ctx = canvas.getContext("2d");
  cv_width = canvas.width;
  cv_height = canvas.height;
  cx = canvas.width / 2;
  cy = canvas.height / 2;
  cent_x = cx + focus_dis; //中心x座標
  cent_y = cy;

  ctx.clearRect(0, 0, cv_width, cv_height);

  ctx.fillStyle = "Red";
  // 楕円軌道アニメ
  var rad = KeplersEquation(radians(time), 0.5);
  var x = Math.cos(rad) * smj_rad;
  var y = Math.sin(rad) * smn_rad;

  ctx.beginPath();
  ctx.arc(cent_x + x * 10, cent_y - y * 10, 10, 0, 2 * Math.PI);
  ctx.fill();
  ctx.stroke();

  time = (time + 2) % 360;
  setTimeout(planet, 1000 / 30);
}
function KeplersEquation(M, e) {
  var E;
  var E0 = M; // 初項
  for (var i = 0; i < 10; i++) {
    E = M + e * Math.sin(E0);
    if (E0 - epsilon < E && E < E0 + epsilon) break;
    E0 = E;
  }
  return E;
}
function radians(degrees) {
  return (degrees * Math.PI) / 180;
}
