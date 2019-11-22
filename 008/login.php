<?php
 include("template/funcs.php");
 include("template/header.html");
?>
<form id="app">
  <form post="witness.php">
    <div>ID: <input type="text" name="lid"></div>
    <div>PASS: <input type="text" name="pass"></div>
    <button type="submit">ログイン</button>
  </form>
</div>

<?php include("template/footer.html"); ?>