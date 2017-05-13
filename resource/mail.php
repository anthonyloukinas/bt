<?php


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

$p = genPass();
$u = substr($firstname, 0, 1) . $lastname;

$mail->Subject = 'Here is the subject';
$mail->Body    = 'Your password is <b>' . $p . '</b> <br>Your username is <b>' . $u . '</b>';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>
