<?php Template::includeTemplate('login_header.php'); ?>
<div role="main" id="main">
  <div id="center-me">
    <form action="/" method="post" name="login">
      <label>Password</label><br>
      <input type="password" tabindex="1" name="password" id="login-password"><br>
      <input type="hidden" name="token" value="<?= Template::get('token'); ?>"><br>
      <input type="button" value="Log In" onclick="document.form.login.submit();">
    </form>
  </div>
</div>
<?php Template::includeTemplate('login_footer.php'); ?>
