"use strict";
(() => {
  const IMAGE_PATH = "./img/sprite.png";

  const HAND_FORMS = [0, 1, 2, 3, 6];
  const HAND_X = [0, 150, 300, 450, 600];
  const HAND_WIDTH = [150, 150, 150, 150, 150];

  const resultImg = [
    "./img/snake_e_frog.png",
    "./img/frog_e_slug.png",
    "./img/slug_e_snake.png"
  ];
  const resultImgG = [
    "./img/snake_e_gohst.png",
    "./img/frog_e_gohst.png",
    "./img/slug_e_gohst.png"
  ];
  const resultImgH = ["./img/house_all_sleep.png", "./img/gohst_at_house.png"];
  const resultImgD = ["./img/drow.png"];

  const cmd_rnd = 7;

  const FPS = 10;

  let isPause = false;

  let currentFrame = 0;

  const canvas = document.getElementById("screen");
  const context = canvas.getContext("2d");

  function main() {
    const imageObj = new Image();
    currentFrame = 0;

    imageObj.onload = function() {
      function loop() {
        if (!isPause) {
          draw_canvas(canvas, context, imageObj, currentFrame++);
        }
        setTimeout(loop, 1000 / FPS);
      }
      loop();
    };
    imageObj.src = IMAGE_PATH;
  }

  function setButtonAction() {
    const hands_mine = document.getElementById("hands_mine");
    const ctx_hands_mine = hands_mine.getContext("2d");
    const imageObj = new Image();

    const rock = $("#rock");
    const scissors = $("#scissors");
    const paper = $("#paper");
    const random = $("#random");
    const restart = $("#restart");
    const command_area = $("#command_area");

    function onClick(event) {
      const myCmd = parseInt(event.target.value, 10);
      const myHandType = getMyCmd(myCmd);
      const enemyHandType = parseInt(currentFrame % HAND_FORMS.length, 10);

      isPause = true;

      draw_mine(canvas, context, imageObj, enemyHandType);
      draw_mine(hands_mine, ctx_hands_mine, imageObj, myHandType);

      judge(myHandType, enemyHandType);
      command_area.attr("class", "none");
    }

    rock.on("click", onClick);
    scissors.on("click", onClick);
    paper.on("click", onClick);
    random.on("click", onClick);

    restart.on("click", function() {
      window.location.reload();
      command_area.removeAttr("class");
    });

    imageObj.src = IMAGE_PATH;
  }

  function draw_mine(canvas, context, imageObject, handIndex) {
    context.clearRect(0, 0, canvas.width, canvas.height);

    const sx = HAND_X[handIndex];
    const swidth = HAND_WIDTH[handIndex];

    draw(canvas, context, imageObject, sx, swidth);
  }

  function draw_canvas(canvas, context, imageObject, frame) {
    context.clearRect(0, 0, canvas.width, canvas.height);

    const handIndex = frame % HAND_FORMS.length;
    const sx = HAND_X[handIndex];
    const swidth = HAND_WIDTH[handIndex];

    draw(canvas, context, imageObject, sx, swidth);
  }

  function draw(canvas, context, imageObject, sx, swidth) {
    context.drawImage(
      imageObject,
      sx,
      0,
      swidth,
      imageObject.height,
      0,
      0,
      swidth,
      canvas.height
    );
  }

  function judge(myHandType, enemyHandType) {
    const htmlResult = result(
      HAND_FORMS[myHandType],
      HAND_FORMS[enemyHandType]
    );
    $("#alert").html(htmlResult);
    $(".js-modal").fadeIn();
  }

  function result(myHand, enemyHand) {
    const HANDS = { 0: "snake", 1: "frog", 2: "slug", 3: "gohst", 6: "house" };
    console.log("me:" + myHand + ":" + HANDS[myHand]);
    console.log("enemy:" + enemyHand + ":" + HANDS[enemyHand]);

    const result = battle(myHand, enemyHand);
    let htmlResult = "<div>";
    if (result === 2) {
      console.log("win");

      htmlResult += '<div><img src ="' + winResult(myHand, enemyHand) + '" alt ="win"></div><p>あなたの勝ちです!</p>';
    } else if (result === 1) {
      console.log("lose");

      htmlResult += '<div><img src ="' + loseResult(myHand, enemyHand) + '" alt ="lose"></div><p>あなたの負けです!</p>';
    } else {
      console.log("drow");

      htmlResult += '<div><img src ="' + drowResult() + '" alt ="drow"></div><p>あいこです!</p>';
    }
    htmlResult += "</div>";
    return htmlResult;
  }

  function battle(myHand, enemyHand) {
    let me = myHand;
    let enemy = enemyHand;
    if (me > 2 || enemy > 2) {
      me = Math.floor(me / 3);
      enemy = Math.floor(enemy / 3);
    }
    return (me - enemy + 3) % 3;
  }

  function getMyCmd(myCmd) {
    let myHand = 0;
    if (myCmd === cmd_rnd) {
      myHand = Math.floor(Math.random() * 5);
    } else {
      myHand = myCmd;
    }
    return myHand;
  }

  function winResult(me, enemy) {
    let src = "";
    switch (me) {
      case 0:
        switch (enemy) {
          case 3:
            src = resultImgG[0];
            break;
          default:
            src = resultImg[0];
            break;
        }
        break;
      case 1:
        switch (enemy) {
          case 3:
            src = resultImgG[1];
            break;
          default:
            src = resultImg[1];
            break;
        }
        break;
      case 2:
        switch (enemy) {
          case 3:
            src = resultImgG[2];
            break;
          default:
            src = resultImg[2];
            break;
        }
        break;
      case 3:
        src = resultImgH[0];
        break;
      case 6:
        src = resultImgH[1];
        break;
      default:
        break;
    }
    return src;
  }
  function loseResult(me, enemy) {
    let src = "";
    switch (me) {
      case 0:
        src = resultImg[2];
        break;
      case 1:
        src = resultImg[0];
        break;
      case 2:
        src = resultImg[1];
        break;
      case 3:
        switch (enemy) {
          case 0:
            src = resultImgG[0];
            break;
          case 1:
            src = resultImgG[1];
            break;
          case 2:
            src = resultImgG[2];
            break;
          default:
            break;
        }
        break;
      case 6:
        src = resultImgH[0];
        break;
      default:
        break;
    }
    return src;
  }
  function drowResult() {
    let src = resultImgD[0];
    return src;
  }

  $(".js-modal-close").on("click", function() {
    $(".js-modal").fadeOut();
    return false;
  });

  setButtonAction();
  main();
})();