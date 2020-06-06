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

if(isset($_POST['status']) == "success")
{
  $email = user_input($_SESSION['CarUserEmail']);
  $status = $_POST['status'];
  $txnid = $_POST['txnid'];
  $amount = $_POST['amount'];
  $time = $_POST['addedon'];
  $product_info = $_POST['productinfo'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['udf3'];
  $address = $_POST['udf4'];
  $brand = $_POST['udf5'];
  $model = $_POST['udf6'];
  $vehicleno = $_POST['udf7'];
  $user_email = $_POST['udf1'];
  $user_mobile = $_POST['udf2'];
  $card_num = $_POST['cardnum'];
  $card_name = $_POST['name_on_card'];

  $query = "UPDATE bookpackage SET plancharge='$amount', status='activated' WHERE txn_id='$txnid' AND email='$email';";
  $result = mysqli_query($conn, $query);

  if($result)
  {
    $message = '
    <div style="max-width:400px;text-align:center;margin:0 auto;">
      <img src="https://www.carecarz.com/images/logo14.png" style="height:100px;width:200px;margin-bottom:1rem;"/>
      <h1>Thank you for Booking(Monthly pack)</h1>
      <p><b>Name : </b>'. $firstname .' ' . $lastname .'</p>
      <p><b>Mobile : </b>'. $user_mobile .'</p>
      <p><b>Email : </b>'. $user_email .'</p>
      <p><b>Vehicle Type : </b>'. $brand .' ' . $model .'</p>
      <p><b>Vehicle no : </b>'. $vehicleno .'</p>
      <p><b>Service : </b>'. $product_info .'</p>
      <p><b>Address : </b>'. $address .'</p>
      <p><b>Payment Status : </b>paid</p>
      <p><b>Txn Id : </b>'.$txnid.'</p>
      <p><b>Charges : </b>'. $amount .'</p>
    </div>
    ';
    //Send_message(919370077950, $message);

    $to = "manojavhale@gmail.com";
    $subject = "Monthly pack Booking from CareCarz";

    sendmail($email, $subject, $message);
    sendmail('manojavhale@gmail.com', $subject, $message);
    $sql = "SELECT * FROM package_details WHERE email='$email' LIMIT 1;";
    $rslt = mysqli_query($conn, $sql);
    $rslt_rows = mysqli_num_rows($rslt);

    if($rslt_rows == 0)
    {
      $query = "INSERT INTO package_details (email, first, second, third, fourth, fifth, sixth, seventh, eightth, nineth, tenth) VALUES ('$email', null, null, null, null, null, null, null, null, null, null);";
      mysqli_query($conn, $query);
    }
  }
  else
  {
    header("location: fail.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Thank You for booking !</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <img style="display:block;height:100px;width:100px;margin:50px auto 0 auto;" src='images/checked.png' alt='success' />
          <h2 style='text-align:center;'>Thank You for booking!</h2>
          <h6 style='margin-bottom: 50px;text-align:center; color:#aaa;'>Our Team member will contact you shortly.</h6>
          <?php if($_POST['status'] == 'success'){ ?>
          <div class="table-responsive">
            <table class="table table-bordered">
              <tr>
                <th>Transaction Id</th>
                <td><?php echo $txnid; ?></td>
              </tr>
              <tr>
                <th>Name</th>
                <td><?php echo $firstname." ".$lastname; ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><?php echo $user_email; ?></td>
              </tr>
              <tr>
                <th>Mobile</th>
                <td><?php echo $user_mobile; ?></td>
              </tr>
              <tr>
                <th>Date</th>
                <td><?php echo date('d-M-Y h:i:sa',strtotime($time)); ?></td>
              </tr>
              <tr>
                <th>Description</th>
                <td><?php echo $product_info; ?></td>
              </tr>
              <tr>
                <th>Amount</th>
                <td><?php echo $amount; ?></td>
              </tr>
              <tr>
                <th>Card No.</th>
                <td><?php echo $card_num; ?></td>
              </tr>
              <tr>
                <th>Payment Status</th>
                <td><?php echo $status; ?></td>
              </tr>
            </table>
          </div>
        <?php } ?>
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
