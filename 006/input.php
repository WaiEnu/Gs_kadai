<?php
 include("funcs.php");
 include("header.html");
?>
<main id="app">
  <h1>生きることは選択の連続だーーー</h1>
  <div class="question">
    <h2>ミッション:ミジンコ君を生き残らせろ</h2>
    <div class="message" v-if="isClear">
      <p><img src="image/game_clear.png" alt="クリア！"></p>
      <p>{{ question }}</p>
    </div>
    <div class="message" v-if="isGameOver">
      <p><img src="image/mijinko_kun_is_dead.png" alt="ミジンコ君(死亡)"></p>
      <p>{{ gameover }}</p>
    </div>
    <div class="message" v-if="hasNext">
      <p><img src="image/mijinko_kun.png" alt="ミジンコ君"></p>
      <p>{{ question }}</p>
    </div>
  </div>
  <h2 id="score">スコア:{{score}}</h2>
  <div class="form" v-if="isForm">
    <form action="write.php" method="post">
      <div>お名前: <input type="text" name="name" value= "名無しさん"></div>
      <div>EMAIL: <input type="text" name="mail" value= "sample@mail.com"></div>
      <div>スコア: {{score}}<input type="hidden" name="score" v-bind:value=score ></div>
      <div><input type="submit" value="送信"></div>
    </form>
  </div>
  <div class="answer" v-else>
    <div class="options" v-if="isGameOver">
      <p>Continue?</p>
      <div class="form">
        <button type="button" @click="continueYes">yes</button>
        <button type="button" @click="continueNo">no</button>
      </div>
    </div>
    <div class="options" v-else>
      <div class="form" v-if="isClear">
        <button v-for="(item, i) in option" :key="item" type="button" @click="continueNo">{{ item }}</button>
      </div>
      <div class="form" v-else>
        <button v-for="(item, i) in option" :key="item" type="button" @click="quizSet(i)">{{ item }}</button>
      </div>
    </div>
  </div>
</main>

<ul>
    <li><a href="input.php">戻る</a></li>
</ul>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
  new Vue({
    el: "#app",
    data: {
      counter:0,
      score:0,
      isGameOver: false,
      isClear: false,
      hasNext: true,
      isForm: false,
      quiz: [
        {
          text: "周りを見渡す",
          option: ["yes", "no"],
          collect: 0,
          gameover: "敵に食われた。",
          endFlg: 0
        },
        {
          text: "何かに気づく",
          option: ["近づく", "逃げる"],
          collect: 1,
          gameover: "敵に食われた。",
          endFlg: 0
        },
        {
          text: "食べ物を探す",
          option: ["匂いのする方", "音のする方"],
          collect: 0,
          gameover: "食べ物がみつからない。",
          endFlg: 0
        },
        {
          text: "魚が来たぞ。でっかいな。",
          option: ["近づく", "近づかない"],
          collect: 1,
          gameover: "魚に食われた。",
          endFlg: 0
        },
        {
          text: "ここになんか入口があるぞ",
          option: ["入る", "入らない"],
          collect: 1,
          gameover: "食虫植物の捕虫器だった。食われた",
          endFlg: 0
        },
        {
          text: "暖かくなってきた",
          option: ["移動", "寝る"],
          collect: 0,
          gameover: "ここ、温泉だった。熱くて生きられない。",
          endFlg: 0
        },
        {
          text: "水の流れが強くなってきた。流されるままに行こうか？",
          option: ["yes", "no"],
          collect: 1,
          gameover: "川岸に打ち上げられた。",
          endFlg: 0
        },
        {
          text: "逃げてばかりなので必殺技を考えよう。取り合えず角をはやす。",
          option: ["yes", "no"],
          collect: 1,
          gameover: "角をはやすのに二十四時間...。そのうちに食われた。",
          endFlg: 0
        },
        {
          text: "水の上には何があるんだろう...。行ってみる？",
          option: ["yes", "no"],
          collect: 1,
          gameover: "水中でしか生きられないの忘れてた。",
          endFlg: 0
        },
        {
          text: "寒くなってきた…冬眠する？",
          option: ["yes", "no"],
          collect: 1,
          gameover: "水が凍った。",
          endFlg: 0
        },
        {
          text: "そして、新天地へ...。",
          option: ["Congraduation!"],
          collect: 1,
          gameover: "",
          endFlg: 1
        }
      ],
    },
    computed: {
      question: function() {
        return this.quiz[this.counter].text;
      },
      option: function() {
        return this.quiz[this.counter].option;
      }
    },
    methods: {
      quizSet: function(value) {
        if (value === this.quiz[this.counter].collect) {
          this.score = this.score+10;
          this.counter++;
          if (this.quiz[this.counter].endFlg === 1) {
            this.isClear = true;
            this.hasNext = false;
          }
        } else {
          this.isGameOver = true;
          this.hasNext = false;
          this.gameover = this.quiz[this.counter].gameover;
          this.counter = 0;
        }
      },
      continueYes: function() {
        this.isGameOver = false;
        this.isClear = false;
        this.hasNext = true;
        this.isForm=false;
        this.score = 0;
        this.counter = 0;
      },
      continueNo: function() {
        this.isForm=true;
      },
    }
  });
</script>
<?php include("footer.html"); ?>