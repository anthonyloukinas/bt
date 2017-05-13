<?php

function check_empty_fields($required_fields_array){
  //initialize an array to store error messages
  $form_errors = array();

  //loop through the required fields array and populate the form with the error array
  foreach($required_fields_array as $name_of_field){
    if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
      $form_errors[] = $name_of_field . " is a required field";
    }
  }
  return $form_errors;
}

function check_min_length($fields){
  //initialize an array to store error messages
  $form_errors = array();

  foreach($fields as $fieldName => $minLen){
    if(strlen(trim($_POST[$fieldName])) < $minLen){
      $form_errors[] = $fieldName . " is too short, must be {$minLen} characters long";
    }
  }
  return $form_errors;
}

function check_email($data){
  //initialize an array to store error messages
  $form_errors = array();
  $key = 'email';
  //check if the key email exists in data array
  if(array_key_exists($key, $data)){

    //check if the email field has a value
    if($_POST[$key] != null){

      //remove all illegal characters from email
      $key = filter_var($key, FILTER_SANITIZE_EMAIL);

      //check if input is a valid email address
      if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
        $form_errors[] = $key . " is not a valid email address";
      }
    }
  }
  return $form_errors;
}

function show_errors($formErrors){
  $errors = "<p><ul style='color: red;'>";

  //loop through error array and display all items in a list
  foreach($formErrors as $error){
    $errors .= "<li>{$error}</li>";
  }
  $errors .= "</ul></p>";
  return $errors;
}

function flashMessage($message, $status = "FAIL"){
  if($status === "FAIL"){
    $data = "<div class='alert alert-danger'><p>{$message}</p></div>";
  }
  elseif ($status === "SUCCESS") {
    $data = "<div class='alert alert-success'><p>{$message}</p></div>";
  }
  return $data;
}

function redirectTo($page){
  header("Location: {$page}.php");
}

function checkDatabase($table, $column, $value, $db){
  try{
    $sqlQuery = "SELECT * FROM $table WHERE $column =:$column";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(":$column" => $value));

    if($row = $statement->fetch()){
      return true;
    }

    return false;
  }catch(PDOException $e){
    //handle exception
  }
}

function rememberMe($user_id){
  $encryptCookieData = base64_encode("UaQteh6i4y3dntstemYODEC{$user_id}");
  // Cookie set to expire in 30 days
  setcookie("rememberUserCookie", $encryptCookieData, time()+60*80^24*100, "/");
}

function isCookieValid($db){
  $isValid = false;

  if(isset($_COOKIE['rememberUserCookie'])){

    // decode cookies and extract user id
    $decryptCookieData = base64_decode($_COOKIE['rememberUserCookie']);
    $user_id = explode("UaQteh6i4y3dntstemYODEC", $decryptCookieData);
    $userID = $user_id[1];

    //check if id retrieved from cookie exists in the database
    $sqlQuery = "SELECT * FROM users WHERE id=:id";
    $stmt = $db->prepare($sqlQuery);
    $stmt->execute(array(':id' => $userID));

    if($row = $stmt->fetch()){
      $id = $row['id'];
      $username = $row['username'];

      // create the user session variable
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
      $isValid = true;
    }else{
      //cookie id is invalid destroy session and logout user
      $isValid = false;
      signout();
    }
  }
  return $isValid;

}

function signout(){
  unset($_SESSION['username']);
  unset($_SESSION['id']);

  if(isset($_COOKIE['rememberUserCookie'])){
    unset($_COOKIE['rememberUserCookie']);
    setcookie('rememberUserCookie', null, -1, '/');
  }
  session_destroy();
  session_regenerate_id(true);
  redirectTo('login');
}

function guard(){

  $isValid = true;
  $inactive = 60 * 15; //15 mins
  $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

  if((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint'] != $fingerprint)){
    $isValid = false;
    signout();
  }else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['username']){
    $isValid = false;
    signout();
  }else {
    $_SESSION['last_active'] = time();
  }

  return $isValid;
}

function isValidImage($file){
  $form_errors = array();
  //jpg gif bmp png
  //split file name into array using dot (.)
  $part = explode(".", $file);
  //target last element in array (.extension)
  $extension = end($part);

  switch(strtolower($extension)){
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
    return $form_errors;
  }
  $form_errors[] = $extension . " is not a valid extension type, please use .jpg, .png, .bmp, .gif";
  return $form_errors;
}

function uploadAvatar($username){

  $isImageMoved = false;

  if($_FILES['avatar']['tmp_name']){
    //file in temp location
    $temp_file = $_FILES['avatar']['tmp_name'];
    $ds = DIRECTORY_SEPARATOR; // uploads/
    $avatar_name = $username.".jpg";

    $path = "uploads".$ds.$avatar_name; //uploads/{username}.jpg

    if(move_uploaded_file($temp_file, $path)){
      $isImageMoved = true;
    }
  }
  return $isImageMoved;
}

function getCount($db, $table){
  $q = "SELECT * FROM $table";
  $s = $db->prepare($q);
  $s->execute();
  $s->fetchAll();
  $t = $s->rowCount();

  return $t;
}

function genPass($length = 9, $add_dashes = false, $available_sets = 'luds')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
	$password = str_shuffle($password);
	if(!$add_dashes)
		return $password;
	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}

function sendMail($firstname, $lastname, $email, $p, $body){
  require 'packages/PHPMailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;

  //$mail->SMTPDebug = 3;                               // Enable verbose debug output

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'fearbawks@gmail.com';                 // SMTP username
  $mail->Password = 'Nothing01!';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('no-reply@butlertech.org', 'donotreply');
  $mail->addAddress($email);               // Name is optional
  $mail->addReplyTo('no-reply@butlertech.org', 'donotreply');

  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML
  $f = ucfirst($firstname);
  $l = ucfirst($lastname);
  $u = substr($firstname, 0, 1) . $lastname;

  $mail->Subject = 'Here is the subject';
  //$mail->Body    = 'Your password is <b>' . $p . '</b> <br>Your username is <b>' . $u . '</b>';
  $mail->Body = $body;

  if(!$mail->send()) {
      $status = 'FAIL';
  } else {
      $status = 'SUCCESS';
  }
  return $status;
}

?>
