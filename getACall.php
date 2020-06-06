<?php
include_once "includes/db.php";

use PHPMailer\PHPMailer\PHPMailer;

include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";
include_once "PHPMailer/SMTP.php";

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


$output = "";
if($_POST['submit'])
{
  if(preg_match("#^[1-9][0-9]*$#", $_POST['mobNo']) && !empty($_POST['mobNo']))
  {
    $mob = user_input($_POST['mobNo']);
    $mob = mysqli_real_escape_string($conn, $mob);

    $query = "INSERT INTO getacall (Mobile, datemade) VALUES ('$mob', '$now');";
    $result = mysqli_query($conn, $query);

    if($result)
    {
      $message = '
      <h1>Call request from</h1>
      <p>'.$mob.'</p>
      ';
      sendmail("krishnabarkule@gmail.com", "Call request", $message);
      $output .= "
      <img style='display:block;height:100px;width:100px;margin:0 auto 0 auto;' src='images/callperson.png' alt='mechanic' />
      <h2 style='text-align:center;'>Thank You!</h2>
      <h5 style='margin-bottom: 50px;text-align:center;'>Our Respresentative will contact you shortly.</h5>
      ";
    }
    else
    {
      $output = "Something went wrong !";
    }
  }
  else
  {
    $output = "Please enter valid mobile number";
  }
}
else
{
  header("location: index.php");
  exit();
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Request A Call</title>

   <link rel="shortcut icon" href="images/icon.png" />

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
   <link rel="stylesheet" href="style/style.css">
 </head>
 <body>
 <div id="bodyWrapper">
   <?php include_once "includes/header.php" ?>
   <div style="text-align:center; margin-top: 50px;"><?php echo "$output"; ?></div>
 </div>
 <?php include_once "includes/footer.php" ?>

 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
 <script src="js/script.js"></script>
 </body>
 </html>
