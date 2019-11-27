<?php
include("funcs.php");

$flg = session_start();

include("template/header.php");
?>
<section>
  <article>
    <div id="input">
      <form method="POST" action="insert_user.php">
        <div class="jumbotron">
          <fieldset>
            <div><label for="name">名前：<input type="text" name="name" value ="<?=$row["name"]?>"></label></div>
            <div><label for="lid">ID：<input type="text" name="lid" value ="<?=$row["lid"]?>"></label></div>
            <div><label for="lpwd">PASS：<input type="text" name="lpwd" value ="<?=$row["lpwd"]?>"></label></div>
            <div>
              <select name="user_options">
              <option value="1">[管理者]</option>
              <option value="2" selected>[一般]</option>
              </select>
            </div>
            <div><input type="submit" value="送信" ></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>

<?php include("template/footer.html"); ?>