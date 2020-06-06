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

$error = "";
if(isset($_POST['cashOnDelivery']))
{
  $fname = user_input($_POST['fname']);
  $lname = user_input($_POST['lname']);
  $mobile = user_input($_POST['mobile']);
  $email = user_input($_POST['email']);
  $brand = user_input($_POST['brand']);
  $model = user_input($_POST['model']);
  $vehicleno = user_input($_POST['vehicleno']);
  $service = user_input($_POST['service']);
  $waxing = user_input($_POST['waxing']);
  $address = user_input($_POST['address']);
  $lat = user_input($_POST['lat']);
  $lng = user_input($_POST['lng']);
  $payment_mode = user_input($_POST['cashOnDelivery']);

  $sql = "SELECT * FROM model WHERE brand='$brand' AND model='$model';";
  $rslt = mysqli_query($conn, $sql);
  $rslt_rows = mysqli_num_rows($rslt);
  $vehicleType = '';

  $wax = 0;
  $charges = 0;
  $discount = 0;    //Discount on all packages
  $total = 0;

  if($rslt_rows > 0)
  {
    while($row = mysqli_fetch_assoc($rslt))
    {
      $vehicleType = $row['vehicleType'];
    }

    if($waxing == 'yes' && ($vehicleType == 'hatchback' || $vehicleType == 'sedan'))
    {
      $wax = 200;
    }
    else if($waxing == 'yes' && $vehicleType == 'suv')
    {
      $wax = 300;
    }
    else
    {
      $wax = 0;
    }

    if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'EcoWash')
    {
      $charges = 99;
    }
    else if($vehicleType == 'suv' && $service == 'EcoWash')
    {
      $charges = 130;
    }
    else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'BasicWash')
    {
      $charges = 99;
    }
    else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'StandardWash')
    {
      $charges = 249;
    }
    else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'PremiumWash')
    {
      $charges = 349;
    }
    else if($vehicleType == 'suv' && $service == 'BasicWash')
    {
      $charges = 149;
    }
    else if($vehicleType == 'suv' && $service == 'StandardWash')
    {
      $charges = 299;
    }
    else if($vehicleType == 'suv' && $service == 'PremiumWash')
    {
      $charges = 399;
    }

    $discount = ceil(($charges + $wax)*0.10);
    $total = ($charges + $wax) - $discount;
  }

  $fname = ucwords($fname);
  $lname = ucwords($lname);
  $vehicleno = strtoupper($vehicleno);

  $query = "INSERT INTO booking (firstname, lastname, mobile, email, brand, model, vehicleno, service, waxing, address, datemade, payment_mode, charges, visited, lat, lng) VALUES ('$fname', '$lname', '$mobile', '$email', '$brand', '$model', '$vehicleno', '$service', '$waxing', '$address', '$now', '$payment_mode', '$total', 0, '$lat', '$lng');";
  $result = mysqli_query($conn, $query);
  if($result)
  {
    $message = '
    <div style="max-width:400px;text-align:center;margin:0 auto;">
      <img src="https://www.carecarz.com/images/logo14.png" style="height:100px;width:200px;margin-bottom:1rem;"/>
      <h1>Thank you for booking!</h1>
      <p><b>Name : </b>'. $fname .' ' . $lname .'</p>
      <p><b>Mobile : </b>'. $mobile .'</p>
      <p><b>Email : </b>'. $email .'</p>
      <p><b>Vehicle Type : </b>'. $brand .' ' . $model .'</p>
      <p><b>Vehicle no : </b>'. $vehicleno .'</p>
      <p><b>Service : </b>'. $service .'</p>
      <p><b>Address : </b>'. $address .'</p>
      <p><b>Payment Mode : </b>'. $payment_mode .'</p>
      <p><b>Waxing : </b>'. $waxing .'</p>
      <p><b>Total : </b>'. $total .'</p>
    </div>
    ';
    //Send_message(919370077950, $message);

    $messageForDriver = '
    <div style="max-width:400px;text-align:center;margin:0 auto;">
      <img src="https://www.carecarz.com/images/logo14.png" style="height:100px;width:200px;margin-bottom:1rem;"/>
      <h1>Booking!</h1>
      <p><b>Name : </b>'. $fname .' ' . $lname .'</p>
      <p><b>Mobile : </b>'. $mobile .'</p>
      <p><b>Email : </b>'. $email .'</p>
      <p><b>Vehicle Type : </b>'. $brand .' ' . $model .'</p>
      <p><b>Vehicle no : </b>'. $vehicleno .'</p>
      <p><b>Service : </b>'. $service .'</p>
      <p><b>Address : </b>'. $address .'</p>
      <p><b>Geolocation : </b>'. $lat .','. $lng .'</p>
      <p><b>Payment Mode : </b>'. $payment_mode .'</p>
      <p><b>Waxing : </b>'. $waxing .'</p>
      <p><b>Total : </b>'. $total .'</p>
    </div>
    ';

    $to = "manojavhale@gmail.com";
    $subject = "Carecarz booking confirmation";

    sendmail($email, $subject, $message);
    if(sendmail('manojavhale@gmail.com', $subject, $messageForDriver))
    {
      header('Location: thankyou.php');
      exit();
    }
    else{
      $error = "Something went wrong ! Try later";
    }
  }
  else
  {
    die("Could not connect to database");
  }
}
else if (isset($_POST['payOnline']))
{

    $fname = user_input($_POST['fname']);
    $lname = user_input($_POST['lname']);
    $mobile = user_input($_POST['mobile']);
    $email = user_input($_POST['email']);
    $brand = user_input($_POST['brand']);
    $model = user_input($_POST['model']);
    $vehicleno = user_input($_POST['vehicleno']);
    $service = user_input($_POST['service']);
    $waxing = user_input($_POST['waxing']);
    $address = user_input($_POST['address']);
    $lat = user_input($_POST['lat']);
    $lng = user_input($_POST['lng']);
    $payment_mode = user_input($_POST['payOnline']);
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

    $sql = "SELECT * FROM model WHERE brand='$brand' AND model='$model';";
    $rslt = mysqli_query($conn, $sql);
    $rslt_rows = mysqli_num_rows($rslt);
    $vehicleType = '';

    $wax = 0;
    $charges = 0;
    $discount = 0;
    $total = 0;

    if($rslt_rows > 0)
    {
      while($row = mysqli_fetch_assoc($rslt))
      {
        $vehicleType = $row['vehicleType'];
      }

      if($waxing == 'yes' && ($vehicleType == 'hatchback' || $vehicleType == 'sedan'))
      {
        $wax = 200;
      }
      else if($waxing == 'yes' && $vehicleType == 'suv')
      {
        $wax = 300;
      }
      else {
        $wax = 0;
      }

      if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'EcoWash')
      {
        $charges = 99;
      }
      else if($vehicleType == 'suv' && $service == 'EcoWash')
      {
        $charges = 130;
      }
      else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'BasicWash')
      {
        $charges = 99;
      }
      else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'StandardWash')
      {
        $charges = 249;
      }
      else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $service == 'PremiumWash')
      {
        $charges = 349;
      }
      else if($vehicleType == 'suv' && $service == 'BasicWash')
      {
        $charges = 149;
      }
      else if($vehicleType == 'suv' && $service == 'StandardWash')
      {
        $charges = 299;
      }
      else if($vehicleType == 'suv' && $service == 'PremiumWash')
      {
        $charges = 399;
      }

      $discount = ceil(($charges + $wax)*0.10);
      $total = ($charges + $wax) - $discount;
    }

    $fname = ucwords($fname);
    $lname = ucwords($lname);
    $vehicleno = strtoupper($vehicleno);

    $query = "INSERT INTO booking (firstname, lastname, mobile, email, brand, model, vehicleno, service, waxing, address, datemade, txn_id, payment_mode, charges, visited, lat, lng) VALUES ('$fname', '$lname', '$mobile', '$email', '$brand', '$model', '$vehicleno', '$service', '$waxing', '$address', '$now', '$txnid', '$payment_mode', '$total', 0, '$lat', '$lng');";
    $result = mysqli_query($conn, $query);
    if($result)
    {
      header('location: formprocess.php?txn_id='.$txnid.'&email='.$email);
    }
    else
    {
      //die("Could not connect to database");
	  echo mysqli_connect_error();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Book Appointment</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
  <style>
  .error{
    color: #f00;
    font-size: 0.9rem;
  }
  </style>
</head>
<body>
<div id="bodyWrapper">
  <?php include_once "includes/header.php" ?>
  <form id="multiphaseBook" action="" method="post" onsubmit="return false;">

    <div>
      <h3>Book your Appointment</h3>
    </div>

    <ul class="dots">
      <li id="d1">1</li>
      <li id="d2">2</li>
      <li id="d3">3</li>
      <li id="d4">4</li>
    </ul>

    <div class="phases">

      <div class="phase show" id="phase1">
        <h6>Select Brand</h6>
        <select id="brand">
          <option value="0" selected="selected">Select</option>
          <?php
          $query = "SELECT * FROM brand;";
          $result = mysqli_query($conn, $query);

          while($row = mysqli_fetch_assoc($result))
          {
            echo "<option value='".$row['brand']."'>".$row['brand']."</option>";
          }
          ?>
        </select>
        <h6>Select Model</h6>
        <select id="model">
          <option value="0" selected="selected">Select</option>
        </select><br/>
        <h6>Vehicle No</h6>
        <input type="text" name="vehicleNo" id="vehicleNo" placeholder="Type vehicle No.">
        <button onclick="processPhase1()">Continue</button>
      </div>

      <div class="phase" id="phase2">
        <h6>Select service you want</h6>
        <select id="selectService" class="form-control">
          <option value="EcoWash">Eco Wash (&#8377; 99)</option>
          <option value="BasicWash">Basic Wash</option>
          <option value="StandardWash">Standard Wash</option>
          <option value="PremiumWash">Premium Wash</option>
        </select>
        <div class="form-group" style="margin-top:2rem;">
          <label for="waxing">Do you want to wax your car ?</label>
          <select id="waxing" class="form-control">
            <option value="no">No</option>
            <option value="yes">Yes</option>
          </select>
          <h6 style="margin: 1rem auto 0 auto;">Extra charges for waxing</h6>
          <p style="font-size:0.9rem;color:#777;">Hatchback, Sedan- Rs 200<br/>Suv - Rs 300</p>
        </div>
        <button style="background:#234163;" onclick="gotoPhase1()">Back</button>
        <button onclick="processPhase2()">Continue</button>
      </div>

      <div class="phase" id="phase3">
        <h6>Your personal details</h6>
        <div>
          <span>Firstname</span><input id="fname" type="text" name="userFname" placeholder="Firstname" />
          <span>Lastname</span><input id="lname" type="text" name="userLname" placeholder="Lastname" />
          <span>Mobile</span><input id="mobile" type="text" name="userMobile" placeholder="Mobile Number" />
          <span>Email</span><input id="formemail" type="text" name="userEmail" placeholder="Email" />
          <span>Address</span><textarea id="homeaddress" rows="2" cols="80" name="userAddr" placeholder="Your Address"></textarea>
          <div style="text-align: left;font-size:0.9rem;color:#777;">Drag marker on your location<span style="color:#f00;display:inline;">**</span></div>
          <div id="map-canvas" style="height: 300px;margin: 5px auto 20px auto;">

          </div>
          <button style="background:#234163;" onclick="gotoPhase2()">Back</button>
          <button onclick="processPhase3()">Continue</button>
        </div>
      </div>

      <div class="phase" id="phase4">
        <h5>Verify your details</h5>
        <div class="table-responsive">
          <table class="table table-striped">
            <tr>
              <th>Name</th>
              <td><span id="showFname"></span> <span id="showLname"></span></td>
            </tr>
            <tr>
              <th>Mobile</th>
              <td><span id="showMobile"></span></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><span id="showEmail"></span></td>
            </tr>
            <tr>
              <th>Address</th>
              <td><span id="showAddress"></span></td>
            </tr>
            <tr>
              <th>Car brand & model</th>
              <td><span id="showBrand"></span> <span id="showModel"></span></td>
            </tr>
            <tr>
              <th>Vehicle registration No.</th>
              <td><span id="showVehicleno"></span></td>
            </tr>
            <tr>
              <th>Your service</th>
              <td><span id="showService"></span></td>
            </tr>
            <tfoot id="showPrice">

            </tfoot>
          </table>
        </div>
        <button style="background:#234163;" onclick="gotoPhase3()">Back</button>
      </div>
    </div>

  </form>

  <form action="" method="post" id='hiddenForm'>
    <input type="hidden" id="hiddenFname" name='fname'/>
    <input type="hidden" id="hiddenLname" name='lname'/>
    <input type="hidden" id="hiddenMobile" name='mobile'/>
    <input type="hidden" id="hiddenEmail" name='email'/>
    <input type="hidden" id="hiddenAddress" name='address'/>
    <input type="hidden" id="hiddenBrand" name='brand'/>
    <input type="hidden" id="hiddenModel" name='model'/>
    <input type="hidden" id="hiddenVehicleno" name='vehicleno'/>
    <input type="hidden" id="hiddenService" name='service'/>
    <input type="hidden" id="hiddenWaxing" name='waxing'/>
    <input type="hidden" name="lat" class="latitude" />
    <input type="hidden" name="lng" class="longitude" />
    <input type="submit" name="cashOnDelivery" value="Pay Cash" />
    <input type="submit" name="payOnline" value="Pay Online" />
  </form>
  <div id="errorLog"><?php echo "$error"; ?></div>
</div>
<?php include_once "includes/footer.php" ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="js/script.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    /* JQUERY validation plugin */
    $.validator.setDefaults({
      highlight: function(element){
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element){
        $(element).removeClass('is-invalid');
        $(element).addClass('is-valid');
      }
    });

    $('#multiphaseBook').validate({
      rules: {
         userFname: {required: true, minlength: 3, nowhitespace: true, lettersonly: true},
         userLname: {required: true, minlength: 3, nowhitespace: true, lettersonly: true},
         userMobile: {
           required: true,
           number: true,
           minlength: 10,
           maxlength: 12
         },
         userEmail: {
           required: true,
           email: true
         },
         userAddr: {required: true}
       }
    });
  });
</script>

<script src="js/googlemap.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYN6swL31dS2PuQtTwzv5Tymo4XTiJD6M&libraries=places&callback=initialize"></script>
</body>
</html>
