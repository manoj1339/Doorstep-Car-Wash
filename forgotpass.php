<?php
session_start();
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
if(isset($_POST['submit']))
{
  $user_email = user_input($_POST['email']);

  if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
  {
    $output = "<span style='color:#f00;'>Enter valid email</span>";
  }
  else
  {
    $query = "SELECT * FROM registration WHERE email='$user_email' LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $result_rows = mysqli_num_rows($result);

    if($result_rows > 0)
    {
      $str = "0123456789abcdefghijklmnopqrstuvwxyz";
      $str = str_shuffle($str);
      $token = substr($str, 0, 20);

      $body = "
      <div style='max-width:400px;text-align:center;margin:0 auto;'>
        <img src='https://www.carecarz.com/images/logo14.png' style='width:200px;height:100px;'/>
      </div>
      <div style='max-width:400px;margin:0 auto;'>
        <h1 style='margin-bottom: 25px;'>Reset password link</h1>
        <p>Hii there,<br/><br/>
        This is the reset password link from carecarz.com<br/>
        To reset the password click on the link below.</p>
        <p><a href='www.carecarz.com/resetpassword.php?token=".$token."&email=".$user_email."'>
          www.carecarz.com/resetpassword.php?token=".$token."&email=".$user_email."
        </a></p>
      </div>
      ";

      $sql = "UPDATE registration SET token='$token' WHERE email='$user_email';";
      $rslt = mysqli_query($conn, $sql);

      if(sendmail($user_email, "Reset password link", $body))
      {
        $output = "<span style='color:#428742;'>Reset password link sent to your email</span>";
      }
      else
      {
        $output = "<span style='color:#f00;'>Please try later !</span>";
      }
    }
    else
    {
      $output = "<span style='color:#f00;'>This email not exist in the database</span>";
    }
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Forgot password</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>

    <div class="container" style="margin-top:5rem;">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form action="" method="post">
            <div class="form-group">
              <input id="useremail" class="form-control" type="text" name="email" placeholder="Enter your email"/>
            </div>
            <div class="form-group" style="text-align:center;">
              <input class="customOrangeBtn" type="submit" name="submit" value="Submit" />
            </div>
            <div style="text-align:center;margin-top:25px;">
              <?php echo "$output"; ?>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
  <?php include_once "includes/footer.php" ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="js/script.js"></script>

</body>
</html>
