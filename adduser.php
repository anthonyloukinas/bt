<?php
  include_once 'partials/header.php';
  include_once 'partials/parseUser.php';
?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Shit</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a type="button" data-toggle="modal" data-target="#addStudent">Student</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Data</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="#" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Students <span class="badge">126</span></a>
              <a href="#" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a>
              <a href="users.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">3</span></a>
            </div>


            <div class="well">
              <h4>Storage</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                  60%
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">

            <div class="panel panel-default"> <!-- panel beginning -->
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Add User</h3>
              </div>
              <div class="panel-body"> <!-- panel body beginning -->
                <?php if(isset($result)) echo $result;?>
                <?php if(!empty($form_errors)) echo show_errors($form_errors);?>
                <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="">
                    </div>
                  </div>
                  <div style="margin: 0; text-align: center !important;">
                    <button type="submit" class="btn btn-lg btn-primary btn-signin" name="sendInvite">Send Invitation</button>
                  </div>
                </form>
              </div> <!-- panel body ending -->
            </div> <!-- panel ending -->
          </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Made with <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> by Anthony Loukinas</p>
    </footer>

    <!-- Modals -->

    <!-- Add Student -->
    <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add Student</h4>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
