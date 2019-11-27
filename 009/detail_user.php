<?php
include("funcs.php");

$id = $_GET["id"];

$pdo = db_conn();

//２．SQL作成
$sql = "SELECT * FROM sng_user_table WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include("template/header.php");
?>
<!-- Main[Start] -->
<section>
  <article>
    <div id="input">
      <form method="POST" action="update_user.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="henshin">返信：</label></div>
            <div><label for="name">名前：<input type="text" name="id" value ="<?=$row["id"]?>"></label></div>
            <div><label for="lid">ID：<input type="text" name="lid" value ="<?=$row["lid"]?>"></label></div>
            <div><label for="lpwd">PASS：<input type="text" name="lpwd" value ="<?=$row["lpwd"]?>"></label></div>
            <div>
            <?php
            $options ='';
            if($row["kanri_flg"]===1){
              $options .='<select name="user_options"><option value="1" selected>[管理者]</option><option value="2">[一般]</option></select>';
            }else{ 
              $options .='<select name="user_options"><option value="1">[管理者]</option><option value="2" selected>[一般]</option></select>';
            }
            echo $options
            ?>
            </div>
            <input type="hidden" name="id" value ="<?=$row["id"]?>">
            <div><input type="submit" value="送信" ></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>
<!-- Main[End] -->

<?php include("template/footer.html"); ?>