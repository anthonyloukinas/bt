<?php
  $page_title = "Activate";
  include_once 'partials/header.php';
  include_once 'partials/parseUser.php';
?>

  <div class="container">
    <div class="flag">
      <h1>Modify Account</h1>
      <?php if(isset($result)) echo $result; ?>
    </div>
    <div class="container">
      <div class="form-signin">
        <form action="" method="post">
          <div class="form-group">
            <label for="new-password">New Password</label>
            <input type="password" name="new-password" class="form-control" id="new-password" placeholder="">
          </div>
          <div class="form-group">
            <label for="confirm-password">Password</label>
            <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="">
          </div>
          <input type="hidden" id="id" name="id" value="<?php if(isset($_GET['id'])) echo $_GET['id']?>">
          <button type="submit" name="changePass" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <?php include_once 'partials/footer.php'; ?>
  </body>
</html>
