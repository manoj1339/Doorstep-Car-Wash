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

$message = "";
if(isset($_POST['fname']) && isset($_POST['lname']))
{
  $fname = user_input($_POST['fname']);
  $lname = user_input($_POST['lname']);
  $mobile = user_input($_POST['mobile']);
  $email = user_input($_POST['email']);
  $brand = user_input($_POST['brand']);
  $model = user_input($_POST['model']);
  $vehicleno = user_input($_POST['vehicleno']);
  $service = user_input($_POST['service']);
  $address = user_input($_POST['address']);

  $fname = ucwords($fname);
  $lname = ucwords($lname);
  $vehicleno = strtoupper($vehicleno);

  $query = "INSERT INTO booking (firstname, lastname, mobile, email, brand, model, vehicleno, service, address, datemade, visited) VALUES ('$fname', '$lname', '$mobile', '$email', '$brand', '$model', '$vehicleno', '$service', '$address', now(), 0);";
  $result = mysqli_query($conn, $query);
  if($result)
  {
    $message = '<h1>Booking</h1>
    <p><b>Name : </b>'. $fname .' ' . $lname .'</p>
    <p><b>Mobile : </b>'. $mobile .'</p>
    <p><b>Email : </b>'. $email .'</p>
    <p><b>Vehicle Type : </b>'. $brand .' ' . $model .'</p>
    <p><b>Vehicle no : </b>'. $vehicleno .'</p>
    <p><b>Service : </b>'. $service .'</p>
    <p><b>Address : </b>'. $address .'</p>
    ';
    //Send_message(919370077950, $message);

    $to = "manojavhale@gmail.com";
    $subject = "Booking from CareCarz";

    if(sendmail('manojavhale@gmail.com', $subject, $message))
    {
      echo "
      <img style='display:block;height:100px;width:100px;margin:50px auto 0 auto;' src='images/mechanic.png' alt='mechanic' />
      <h2 style='text-align:center;'>Thank You for booking!</h2>
      <h5 style='margin-bottom: 50px;text-align:center;'>Our Team member will contact you shortly.</h5>
      <p style='color:#aaa;text-align:center;'>**Pay to our technician at your doorstep.</p>
      ";
    }
    else{
      echo "Something went wrong !";
    }
  }
  else
  {
    die("Could not connect to database");
  }
}
else
{
  header('location: index.php');
  exit();
}
?>
