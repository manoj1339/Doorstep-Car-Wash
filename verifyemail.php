<?php
session_start();
include_once "includes/db.php";

$output = "";
if(isset($_GET['email']))
{
  $email = user_input($_GET['email']);

  $query = "SELECT * FROM registration WHERE email='$email';";
  $result = mysqli_query($conn, $query);

  if($result)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $otp = $row['otp'];
    }
  }


  if(isset($_POST['submit']))
  {
    $user_entered_otp = user_input($_POST['otp']);

    if(strlen($user_entered_otp) < 5)
    {
      $output = "Wrong OTP";
    }
    else if($otp == $user_entered_otp)
    {
      $sql = "UPDATE registration SET status='1', otp='0' WHERE email='$email';";
      $rslt = mysqli_query($conn, $sql);

      if($rslt)
      {
        $_SESSION['CarUserEmail'] = "$email";
        header('location: myaccount.php');
        exit();
      }
    }
    else
    {
      $output = "Wrong OTP";
    }
  }
}
else {
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
  <title>Verify Email</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
  <style type="text/css">
     input[type="submit"]{
       text-align: center;
       padding: 12px;
       color: #fff;
       background: #c73000;
       font-size: 1rem;
       border: none;
       outline: none;
       cursor: pointer;
     }

     input[type="text"]
     {
       font-size: 1rem;
       padding: 12px;
       border-radius: 8px;
       margin-bottom: 1rem;
     }

     h6{
       margin-bottom: 1.5rem;
     }

     .col-md-6 p{
       text-align: center;
       color: #f00;
       font-weight: bold;
       font-size: 0.8rem;
       margin-top: 1rem;
     }
  </style>
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>

    <div class="container" style="margin-top: 4rem;">
      <div class="row justify-content-center" style="text-align:center;">
        <div class="col-md-6">
          <h6>Enter OTP sent on your Email Id</h6>
          <form action="" method="post">
            <input type="text" name="otp" placeholder="Enter OTP here"/><br/>
            <input type="submit" value="submit" name="submit" />
          </form>
          <p><?php echo "$output"; ?></p>
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
