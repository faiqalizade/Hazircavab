<?php if (isset($_COOKIE['loged_admin_verify'])):
  $verifyadmin = R::findOne('admin','id = ?', [$_COOKIE['loged_admin_id']]);
  if ($_COOKIE['loged_admin_verify'] == $verifyadmin->password) {
    require 'templates/adminpanel.php';
  }
  ?>
<?php else: ?>
<form action="index.php?page=adminalfa" method="post" id="adminlogin">
  <label for="login">Login</label><input required type="text" name="login" placeholder="Admin Login" id="login" autofocus>
  <label for="password">Password</label><input required type="password" placeholder="Admin Password" name="password" id="password">
  <input style='margin-top: 2%;' type="submit" name='knopka' value="Giris">
</form>
<?php endif;?>
