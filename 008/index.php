<?php
 include("funcs.php");
/**
 //1.  DB接続します
 $pdo =  db_conn();
 
 //２．データ登録SQL作成
 $stmt = $pdo->prepare("SELECT * FROM sng_question_table ORDER BY score DESC, indate DESC");
 $status = $stmt->execute();
 
 //３．データ表示
 $view="";
 if($status==false) {
   //execute（SQL実行時にエラーがある場合）
   sql_error($stmt);
 
 }else{
   //Selectデータの数だけ自動でループしてくれる
   //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php   
   while( $result[] = $stmt->fetch(PDO::FETCH_ASSOC));
   $json=json_encode($result , JSON_UNESCAPED_UNICODE);
 }
  */
 include("template/header.html");
?>
<div id="app">
  <div v-if="isInit">
    <div>お名前: <input type="text" v-model="name"></div>
    <div>EMAIL: <input type="text" v-model="email"></div>
    <button type="button" @click="start">始める</button>
  </div>
  <div v-else>
    <h1>生きることは選択の連続だーーー</h1>
    <div class="question">
      <h2>ミッション:ミジンコ君を生き残らせろ</h2>
      <h3 id="score">プレイヤー:{{name}}</h3>
      <h3 id="score">スコア:{{score}}</h3>
      <div class="message" v-if="isClear">
        <p><img src="image/game_clear.png" alt="クリア！"></p>
        <p>{{ endMessage }}</p>
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
    <div class="form" v-if="isForm">
      <form action="insert.php" method="post">
        <input type="hidden" name="score" v-bind:value=score>
        <input type="hidden" name="name" v-bind:value=name>
        <input type="hidden" name="email" v-bind:value=email>
        <div><input type="submit" value="送信"></div>
      </form>
    </div>
    <div class="answer" v-else>
      <div class="options">
        <p v-if="isGameOver">Continue?</p>
        <div class="form" v-if="isGameOver">
          <button type="button" @click="continueYes">yes</button>
          <button type="button" @click="continueNo">no</button>
        </div>
        <div class="form" v-if="isClear">
          <button type="button" @click="continueNo">{{endOption}}</button>
        </div>
        <div class="form" v-if="hasNext">
          <button v-for="(item, i) in option" :key="item" type="button" @click="quizSet(i)">{{ item }}</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("template/vuejs.html"); ?>
<?php include("template/footer.html"); ?>