<?php
  include_once 'resource/database.php';
  include_once 'resource/utilities.php';
  include_once 'resource/session.php';
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php if(isset($page_title)) echo $page_title; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="css/sweetalert.css" rel="stylesheet">
    <script src="js/sweetalert.min.js"></script>

    </head>
    <body>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">B_Tech</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav"><i class="hide"><?php echo guard(); ?></i>
              <li><a href="index.php">Home</a></li>
              <?php if((isset($_SESSION['username']) || isCookieValid($db))): ?>
                <li><a href="profile.php">Profile</a></li>
              </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php">Logout</a></li>
                  <li><a href="test.html">Welcome, <?php echo $_SESSION['firstname']; ?></a></li>
                </ul>
              <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                </ul>
              <?php endif ?>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
