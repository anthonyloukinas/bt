<?php
  //add our database connection script
  include_once 'resource/database.php';
  include_once 'resource/utilities.php';

  //process the form
  if(isset($_POST['sendInvite'])){
    //init an aray to store any error message from the form
    $form_errors = array();

    //form validation
    $required_fields = array('email', 'firstname', 'lastname');

    //call the function to check empty field and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //fields that require checking for minimum length
    //$fields = array('username' => 4, 'password' => 8);

    //call the function to check min required length and merge the return data into form_error array
    //$form_errors = array_merge($form_errors, check_min_length($fields));

    //email validation / merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_email($_POST));

    //collect form data and store in variables
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = genPass();
    $username = substr($firstname, 0, 1) . $lastname;

    if(checkDatabase("users", "email", $email, $db)){
      $result = flashMessage("Email is already taken", "FAIL");
    }
    else if(empty($form_errors)){

      //hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      try{
        //create SQL insert statement
        $sqlInsert = "INSERT INTO users (firstname, lastname, username, email, password, join_date)
                      VALUES (:firstname, :lastname, :username, :email, :password, now())";

        //use PDO prepared to sanitize data
        $statement = $db->prepare($sqlInsert);

        //add the data into the database
        $statement->execute(array(':firstname' => ucfirst($firstname), ':lastname' => ucfirst($lastname),':username' => $username, ':email' => $email, ':password' => $hashed_password));

        if($statement->rowCount() == 1){

          //get last inserted "id" aka row
          $user_id = $db->lastInsertId();
          //encode the id
          $encode_id = base64_encode("encodethisshit{$user_id}");

          //prepare
          $mail_body = '<html>
          <body style="background-color: #cccccc; color: #000; font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
          <h2>ButlerTech CMS</h2>
          <p>Dear ' . ucfirst($firstname) . ' ' . ucfirst($lastname) . ' please activate your account by clinking the link below.</p>
          <p>Your username to login is : <strong>' . $username . '</strong></p>
          <p><a href="http://localhost/bt/activate.php?id=' . $encode_id . '">Activate Account</a></p>
          <p><strong>&copy; 2017  - Anthony Loukinas</strong></p>
          </body>
          </html>';

          if(sendMail($firstname, $lastname, $email, $password, $mail_body) === 'FAIL'){
            $result = "<script type=\"text/javascript\">
              swal({
                title: \"Oops..\",
                text: \"Failed to add user, please try again.\",
                type: 'error',
                confirmButtonText: \"Close\" });
            </script>";
          }
          else{
            $result = "<script type=\"text/javascript\">
              swal({
                title: \"Congratulations $firstname added!\",
                text: \"User will recieve login details directly to their email address.\",
                type: 'success',
                timer: 3000,
                showConfirmButton: false  });
                setTimeout(function(){
                  window.location.href = 'users.php';
                }, 2500);
            </script>";
          }
        }
      }
      catch(PDOException $e){
        $result = "<p style='padding: 20px; color: red;'> An error has occured :".$e->getMessage()."</p>";
      }
    }
  }

  if(isset($_POST['changePass'])){
    $form_errors = array();
    $required_fields = array('new-password', 'confirm-password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    $encoded_id = $_POST['id'];
    $decode_id = base64_decode($encoded_id);
    $user_id_array = explode("encodethisshit", $decode_id);
    $id = $user_id_array[1];

    $sql = "UPDATE users SET activated =:activated WHERE id=:id AND activated='0'";

    $stmt = $db->prepare($sql);
    $stmt->execute(array(':activated' => '1', ':id' => $id));

    if($stmt->rowCount() == 1){
      $result = "<h2>Account Activated</h2>
      <p>Your account has been activated. You may now <a href='login.php'>Login</a> with your username and password.</p>";
    }else{
      $result = "<p>Error</p>";
    }

    if(empty($form_errors)){
      if($new_password != $confirm_password){
        $result = flashMessage("Passwords do not match", "FAIL");
      }
      else{
        try{
          $sqlQuery = "SELECT id FROM users WHERE id=:id";

          $stmt = $db->prepare($sqlQuery);

          $stmt->execute(array(':id' => $id));

          if($stmt->rowCount() == 1){
            $hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);

            $sqlUpdate = "UPDATE users SET password =:hashed_password WHERE id =:id";

            $stmt = $db->prepare($sqlUpdate);

            $stmt->execute(array(':hashed_password' => $hashed_password, ':id' => $id));

            $result = "<script type=\"text/javascript\">
              swal({
                title: \"Password has been changed!!\",
                text: \"You may now login to the system using this password.\",
                type: 'success',
                timer: 3000,
                showConfirmButton: false  });
                setTimeout(function(){
                  window.location.href = 'login.php';
                }, 2500);
            </script>";

          }
        }catch(PDOException $e){
          $result = "<p style='padding: 20px; color: red;'> An error has occured :".$e->getMessage()."</p>";
        }
      }
    }
  }

?>
