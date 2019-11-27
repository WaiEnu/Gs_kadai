<?php
 include("funcs.php");
 include("template/header.php");
?>

<section>
  <article>
    <div id="input">
      <form method="POST" post="admin.php">
        <div class="jumbotron">
          <fieldset>
            <div>ID: <input type="text" name="lid"></div>
            <div>PASS: <input type="text" name="lpwd"></div>
            <div><input type="submit" value="ログイン"></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>

<?php include("template/footer.html"); ?>