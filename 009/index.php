<?php
include("funcs.php");
?>

<header>
  <nav class="navbar navbar-default">LOGIN</nav>
</header>

<section>
  <article>
    <div id="input">
      <form method="POST" action="admin.php">
        <div class="jumbotron">
          <fieldset>
            <div>ID: <input type="text" name="lid"></div>
            <div>PASS: <input type="password" name="lpwd"></div>
            <div><input type="submit" value="ログイン"></div>
          </fieldset>
        </div>
      </form>
    </div>
  </article>
</section>

<?php include("template/footer.html"); ?>