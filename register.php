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


$registerError = "";
if(isset($_POST['submit']))
{
  $fname = user_input($_POST['registerFname']);
  $lname = user_input($_POST['registerLname']);
  $mob = user_input($_POST['registerMob']);
  $alternatemob = user_input($_POST['alternate']);
  $brand = user_input($_POST['registerBrand']);
  $model = user_input($_POST['registerModel']);
  $vehicleno = user_input($_POST['registervehicleNo']);
  $address = user_input($_POST['homeaddress']);
  $email = user_input($_POST['registerEmail']);
  $pwd = user_input($_POST['pwd']);
  $cpwd = user_input($_POST['cpwd']);

  $vehicleno = strtoupper($vehicleno);

  $fname = ucfirst($fname);
  $lname = ucfirst($lname);
  $email = strtolower($email);

  $registerError = $fname." ".$lname." ".$mob." ".$alternatemob." ".$brand;

  // VALIDATING USER INPUT DATA
  if($fname=="" || $lname=="" || $email=="" || $mob=="" || $pwd=="")
  {
    $registerError = "Please fill all fields";
  }
  else if(strlen($fname) < 3 || strlen($lname) < 3)
  {
    $registerError = "Firstname & lastname >= 3 chars";
  }
  else if(!preg_match("/^[a-zA-z]*$/", $fname))
  {
    $registerError = "Firstname contain letters only";
  }
  else if(!preg_match("/^[a-zA-z]*$/", $lname))
  {
    $registerError = "Lastname contain letters only";
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    $registerError = "Invalid Email";
  }
  else if(!preg_match("/^[0-9{10}]*$/", $mob))
  {
    $registerError = "Invalid Mobile";
  }
  else if($brand == "0")
  {
    $registerError = "Please select brand";
  }
  else if($model == "0")
  {
    $registerError = "Please select model";
  }
  else if($address == "")
  {
    $registerError = "Type correct address";
  }
  else if($vehicleno == "")
  {
    $registerError = "Give your vehicle No.";
  }
  else if(strlen($pwd) < 6 || strlen($pwd) > 20)
  {
    $registerError = "Password between 6-20 characters";
  }
  else if($pwd != $cpwd)
  {
    $registerError = "Password & Confirm password must be same";
  }
  else
  {

    $query = "SELECT * FROM registration WHERE mobile='$mob' OR email='$email';";
    $rslt = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($rslt);
    if($rows > 0)
    {
      $registerError = "This Mobile OR Email already registered.";
    }
    else
    {
      $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
      $otp = mt_rand(100000, 999999);

      $sql = "INSERT INTO registration (firstname, lastname, mobile, alternate, brand, model, vehicleno, address, email, password, datemade, otp) VALUES ('$fname', '$lname', '$mob', '$alternatemob', '$brand', '$model', '$vehicleno', '$address', '$email', '$hashed_pwd', '$now', '$otp');";
      $result = mysqli_query($conn, $sql);
      if($result)
      {
        $subject = "Verify your Email";
        $body = "
        <div style='max-width:400px;text-align:center;margin:0 auto;'>
          <img src='https://www.carecarz.com/images/logo14.png' style='width:200px;height:100px;'/>
        </div>
        <div style='max-width:400px;margin:0 auto;'>
          <p>Hii there</p>
          <p>Your email verification <b>OTP</b> is ". $otp ."</p>
        </div>
        ";

        if(sendmail($email, $subject, $body))
        {
          header("location: verifyemail.php?email=$email");
        }
        else
        {
          $registerError = "Please try later";
        }

      }
      else
      {
        $registerError = "Something went wrong!";
      }
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
  <title>Registration</title>

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

    <div id="registerForm">
      <form id="form" method="post" action="" enctype="multipart/form-data">
        <h2>Registration</h2>
        <div class="form-group">
          <label for="registerFname">Firstname</label>
          <input type="text" name="registerFname" id='registerFname' class="form-control" placeholder="Firstname" />
        </div>
        <div class="form-group">
          <label for="registerLname">Lastname</label>
          <input type="text" name="registerLname" id='registerLname' class="form-control" placeholder="Lastname" />
        </div>
        <div class="form-group">
          <label for="registerMob">Mobile</label>
          <input type="text" name="registerMob" id='registerMob' class="form-control" placeholder="Mobile No." />
        </div>
        <div class="form-group">
          <label for="alternate">Alternate Mobile</label>
          <input type="text" name="alternate" id='alternate' class="form-control" placeholder="Alternate Mobile No." />
        </div>
        <div class="form-group">
          <select id="registerBrand" name="registerBrand" class="form-control">
            <option value="0" selected="selected">Select Brand</option>
            <?php
            $query = "SELECT * FROM brand;";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result))
            {
              echo "<option value='".$row['brand']."'>".$row['brand']."</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <select id="registerModel" name="registerModel" class="form-control">
            <option value="0" selected="selected">Select Model</option>
          </select>
        </div>
        <div class="form-group">
          <label for="registervehicleNo">Vehicle No.</label>
          <input type="text" name="registervehicleNo" id="registervehicleNo" class="form-control" placeholder="Type vehicle no.">
        </div>
        <div class="form-group">
          <label for="homeaddress">Address / Area</label>
          <textarea id="homeaddress" name="homeaddress" rows="4" cols="80" class="form-control" placeholder="Your Address"></textarea>
        </div>
        <div class="form-group">
          <label for="registerEmail">Email</label>
          <input type="text" name="registerEmail" id='registerEmail' class="form-control" placeholder="Email" />
        </div>
        <div class="form-group">
          <label for="pwd">Password</label>
          <input type="password" id='pwd' name="pwd" class="form-control" placeholder="Password" />
        </div>
        <div class="form-group">
          <label for="cpwd">Confirm Password</label>
          <input type="password" id='cpwd' name="cpwd" class="form-control" placeholder="Confirm Password" />
        </div>
        <div>
          <input type="submit" name="submit" value="Register" class="form-control"/>
        </div>
        <div id="registerError">
          <?php echo "$registerError"; ?>
        </div>
        </form>
    </div>

  </div>
  <?php include_once "includes/footer.php" ?>

  <!-- Script files -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  <script src="js/script.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    $('#registerBrand').on('change', function(){
      var brand = $(this).val();
      $.ajax({
        method: 'post',
        data: {brand:brand},
        url: 'dropdown.php',
        success: function(data)
        {
          $('#registerModel').html(data);
        }
      });
    });

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

    $.validator.addMethod("notEqualTo", function(value, element, param){
      return this.optional(element) || value != param;
    },'This Field is Required');

    $.validator.addMethod("customemail",
      function(value, element) {
          return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
      },
      "Enter valid email address"
    );

    $('#form').validate({
      rules: {
         registerFname: {required: true, minlength: 3, nowhitespace: true, lettersonly: true},
         registerLname: {required: true, minlength: 3, nowhitespace: true, lettersonly: true},
         registerMob: {
           required: true,
           number: true,
           minlength: 10,
           maxlength: 12,
           remote: {
             url: 'checkEmailMobile.php',
             type: 'post'
           }
         },
         alternate: {required: true, number: true, minlength: 10, maxlength: 12},
         registerBrand: {required: true, notEqualTo: '0'},
         registerModel: {required: true, notEqualTo: '0'},
         registervehicleNo : {required: true},
         homeaddress: {required: true, minlength: 5},
         registerEmail: {
           required: true,
           customemail:true,
           remote:{
             url: 'checkEmailMobile.php',
             type: 'post'
           }
         },
         pwd: {required: true, minlength: 6},
         cpwd: {required: true, minlength: 6, equalTo: '#pwd'}
       },
       messages:{
         registerBrand: {
           notEqualTo: 'Please select Brand'
         },
         registerModel: {
           notEqualTo: 'Please select Model'
         },
         registerMob: {
           remote: 'This Mobile is already registered'
         },
         registerEmail: {
           remote: 'This email is already registered'
         }
       }
    });
  });
  </script>
</body>
</html>
