
const planetImg =new Array('./img/kitten.gif','./img/burning.gif','./img/freezing.gif');

const epsilon = 1.0e-14;
var times = 0;
var degree = 0;     //中心点からの角度
var drawRadius = 10;   //動かしたい円の半径
var ex = [];	// ellipse
var ey = [];
var time = 0;
var time2 = 0;

onload = function(){
  var canvas = document.getElementById('planet_disp');
  ctx = canvas.getContext("2d");
  cx = canvas.width / 2;
  cy = canvas.height / 2;  
  e = 0.5;
  a = 200;
  b = Math.sqrt((1 - e * e) * a * a);
  for (var t = 0; t < 360; t += 5) {
    var rad = radians(t);
    ex.push(cx + Math.cos(rad) * a);
    ey.push(cy + Math.sin(rad) * b);
  }
  planet();
  planet_hz();
};
 

function planet_hz(){
  let cent_x = cx/2;//中心x座標
  let cent_y = cy/2;

  const arr_hbzArea = JSON.parse(localStorage.getItem(hbzArea));

  img1 = new Image();
  img1.src = planetImg[0];
    draw_planet_hz(img1,cent_x,cent_y,arr_hbzArea.rad_habitat);
  img1.onload = function(){
  }
  img2 = new Image();
  img2.src = planetImg[1];
    draw_planet_hz(img2,cent_x,cent_y,arr_hbzArea.rad_burned);
  img2.onload = function(){
  }
  img3 = new Image();
  img3.src = planetImg[2];
    draw_planet_hz(img3,cent_x,cent_y,arr_hbzArea.rad_freezed);
  img3.onload = function(){
  }

	degree++;
};
function draw_planet_hz(img,cent_x,cent_y,moveRadius){
  ctx.beginPath();

  //x座標とy座標を計算
  var x = Math.cos( Math.PI / 180 * degree) * moveRadius + cent_x;
  var y = Math.sin( Math.PI / 180 * degree) * moveRadius + cent_y;

  ctx.drawImage(img,x,y);
  ctx.closePath();
}

function planet(){
  const arr_moveOrbit = JSON.parse(localStorage.getItem(moveOrbit));

  let smj_rad = arr_moveOrbit.smj_rad;
  let smn_rad = arr_moveOrbit.smn_rad;
  let focus_dis = arr_moveOrbit.focus_dis;

  let cent_x = cx/2 + focus_dis;//中心x座標
  let cent_y = cy/2;

  ctx.clearRect(0, 0, cv_width, cv_height);
  planet_hz();

	ctx.fillStyle = "Red";
 	// 楕円軌道アニメ
	var rad = KeplersEquation(radians(time));
	var x = Math.cos(rad) * smj_rad;
	var y = Math.sin(rad) * smn_rad;

	ctx.beginPath();
	ctx.arc(cent_x + x*10, cent_y - y*10, 10, 0, 2 * Math.PI);
	ctx.fill();
	ctx.stroke();
   
	time = (time + 2) % 360;
	setTimeout(planet, 1000 / 30);
}
function KeplersEquation(M) {
	var E;
	var E0 = M;	// 初項
	for (var i = 0; i < 10; i++) {
		E = M + e * Math.sin(E0);
		if ((E0 - epsilon < E) && (E < E0 + epsilon)) break;
		E0 = E;
	}
	return E;
}
function radians(degrees) {
	return degrees * Math.PI / 180;
}