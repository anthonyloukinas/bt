<?php
$page_title = 'Login';
include_once 'partials/header.php';
include_once 'partials/parseLogin.php';
?>
    <div class="container">
      <form class="form-signin" action="" method="post">
        <h1 class="form-signin-heading" style="text-align: center;">Login</h1>
        <hr>
        <?php if(isset($result)) echo $result;?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors);?>
        <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" id="username" name="username" class="form-control" placeholder="Username"  autofocus>
        </div>
        <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="yes" name="remember"> Remember me
          </label>
          <button class="btn btn-primary main-color-bg pull-right" name="loginBtn" type="submit">Sign in</button>

        </div>
        <a href="forget.php">Forgot Password?</a>
      </form>
    </div>
    <?php include_once 'partials/footer.php'; ?>
  </body>
</html>
