<?php
  include_once 'resource/database.php';
  include_once 'resource/utilities.php';

  if(isset($_POST['loginBtn'])){
    //array to hold errors
    $form_errors = array();

    //validate
    $requiredFields = array('username', 'password');

    //check if any fields are empty
    $form_errors = array_merge($form_errors, check_empty_fields($requiredFields));

    if(empty($form_errors)){

      //collect form data
      $username = $_POST['username'];
      $password = $_POST['password'];

      isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";

      //check if user exists in database
      $sqlQuery = "SELECT * FROM users WHERE username = :username";
      $stmt = $db->prepare($sqlQuery);
      $stmt->execute(array(':username' => $username));

      while($row = $stmt->fetch()){
        $id               = $row['id'];
        $username         = $row['username'];
        $hashed_password  = $row['password'];
        $firstname        = $row['firstname'];
        $activated        = $row['activated'];

        if($activated != 1){
          $result = flashMessage("The account is not activated please check your email for an activation link", "FAIL");
        }else{
          if(password_verify($password, $hashed_password)){
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;

            $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
            $_SESSION['last_active'] = time();
            $_SESSION['fingerprint'] = $fingerprint;

            if($remember === "yes"){
              rememberMe($id);
            }

            //call sweet alert function
            echo $welcome = "<script type=\"text/javascript\">
              swal({
                title: \"Welcome back $firstname!\",
                text: \"You're being logged in.\",
                type: 'success',
                timer: 2500,
                showConfirmButton: false });

                setTimeout(function(){
                  window.location.href = 'index.php';
                }, 1500);
            </script>";
            //redirectTo("index");
          }else{
            $result = '<div style="text-align: center;">' . flashMessage("Invalid username or password") . '</div>';
            //$result = "<p style='padding: 20px; color: red; border: 1px solid gray'>Invalid username or password</p>";
          }
        }
      }
    }else{
        $result = "<p style='color: red;'>There is an error in the form</p>";
    }
  }
?>
