<?php
 include("template/funcs.php");
 include("template/header.html");
?>

<section>
  <article>
    <div id="input">
      <form method="POST" post="admin.php">
        <div>ID: <input type="text" name="lid"></div>
        <div>PASS: <input type="text" name="pass"></div>
        <button type="submit">ログイン</button>
      </form>
    </div>
  </article>
</section>

<?php include("template/footer.html"); ?>