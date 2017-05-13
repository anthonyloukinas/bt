            <div class="list-group">
              <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="#" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Students <span class="badge">126</span></a>
              <a href="#" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Settings</a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo getCount($db, 'users'); ?></span></a>
            </div>


            <div class="well">
              <h4>Storage</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                  60%
                </div>
              </div>
            </div>