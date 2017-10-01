<?php
  $page_title = 'Users';
  include_once 'partials/header.php';

  $q = 'SELECT * FROM users';
  $s = $db->prepare($q);
  $s->execute();

  $rows = $s->fetchAll();

  if(isset($_POST['deleteBtn'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $session_id = $_SESSION['id'];

    if($id != $session_id){

      echo $test = "<script type=\"text/javascript\">
        swal({
          title: \"Are you sure?\",
          text: \"You will not be able to recover this account " . $username . "\",
          type: \"warning\",
          showCancelButton: true,
          confirmButtonColor: \"#DD6B55\",
          confirmButtonText: \"Yes, delete it!\",
          closeOnConfirm: false,
          html: true
          },
          function(){
            swal({
              title: \"Deleted!\",
              text: \"Account has been deleted.\",
              type: \"success\",
              showConfirmButton: false
            });
            setTimeout(function(){
              window.location = \"delete_user.php?id=$id\"
            }, 1500);
          });
      </script>";
    }
    else{
      echo $test = "<script type=\"text/javascript\">
        swal(\"Oops...\", \"You cannot delete yourself!\", \"error\");
      </script>";
    }
  }

  //print_r($done);
?>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your Shit</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create pull-right">
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
            <?php include_once 'partials/sidebar.php'; ?>
            </div>
          <div class="col-md-9">
            <div class="panel panel-default"> <!-- panel beginning -->
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Overview</h3>
              </div>
              <div class="panel-body"> <!-- panel body beginning -->
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo getCount($db, 'users'); ?></h2>
                    <h4>Users</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-education" aria-hidden="true"></span> 209</h2>
                    <h4>Students</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 3091</h2>
                    <h4>Visits</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-download" aria-hidden="true"></span> 1</h2>
                    <h4>Updates</h4>
                  </div>
                </div>
              </div> <!-- panel body ending -->
            </div> <!-- panel ending -->

            <!-- Latest Students-->

            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>Account</th>
                    <th>Status</th>
                    <th>Creation</th>
                    <th>Delete</th>
                  </tr>
                  <?php foreach($rows as $row): ?>
                  <tr>
                    <td><?php echo $row['firstname']; ?> @<?php echo $row['username']; ?></td>
                    <td>
                      <div style="">
                        <p></p>
                        <p>
                          <?php 
                            if($row['activated'] == 1){ 
                              echo '<span class="label label-success">Active</span>';
                            }
                            else{ 
                              echo '<span class="label label-danger">Inactive</span>';
                            }
                          ?>
                        </p>
                      </div>
                    </td>
                    <td><?php echo $row['join_date']; ?></td>
                    <td>
                      <form action="" method="post">
                        <button type="submit" name="deleteBtn" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <input type="text" class="hidden" id="id" name="id" value="<?php echo $row['id']?>"></input>
                        <input type="text" class="hidden" id="username" name="username" value="<?php echo $row['username']; ?>"></input>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach?>
                </table>
                <a class="btn btn-success pull-right" href="adduser.php">New User</a>
              </div>
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
    <script src="js/main.js"></script>
  </body>
</html>
