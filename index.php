<?php
  $page_title = 'Dashboard';
  include_once 'partials/header.php';
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
                <h3 class="panel-title">Latest Users</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>First</th>
                    <th>Last</th>
                    <th>Date</th>
                  </tr>
                  <tr>
                    <td>Anthony</td>
                    <td>Loukinas</td>
                    <td><?php echo genPass(); ?></td>
                  </tr>
                  <tr>
                    <td>Daniel</td>
                    <td>Lynch</td>
                    <td><?php echo genPass(); ?></td>
                  </tr>
                  <tr>
                    <td>Jeremy</td>
                    <td>Loukinas</td>
                    <td><?php echo genPass(); ?></td>
                  </tr>

                </table>
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
