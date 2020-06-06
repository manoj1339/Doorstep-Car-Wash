<?php

function sendmail($to, $subject, $body)
{
  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  //Server settings

  //$mail->SMTPDebug = 1;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'mail.carecarz.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'info@carecarz.com';                 // SMTP username
  $mail->Password = 'OMsai@3406';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;   	// TCP port to connect to
  
  $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
  );

  //Recipients
    // Add a recipient
  $mail->setFrom('info@carecarz.com', 'Carecarz');
  $mail->addAddress("$to");               // Name is optional


  //Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = "$subject";
  $mail->Body    = "$body";

  if($mail->send())
  {
    return true;
  }
  else
  {
    return false;
  }
}

?>