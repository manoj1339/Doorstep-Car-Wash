<?php
session_start();
include_once "includes/db.php";

if(isset($_SESSION['CarUserEmail']))
{
  $user_email = user_input($_SESSION['CarUserEmail']);

  $firstname=$lastname=$mobile=$alternate=$address="";

  if(isset($_POST['submit']))
  {
    $firstname = user_input($_POST['firstname']);
    $lastname = user_input($_POST['lastname']);
    $mobile = user_input($_POST['mobile']);
    $alternate = user_input($_POST['alternate']);
    $address = user_input($_POST['addr']);

    if($firstname=="" || $lastname=="" || $mobile=="" || $address=="")
    {
      $registerError = "Please fill all fields";
    }
    else if(strlen($firstname) < 3 || strlen($lastname) < 3)
    {
      $registerError = "Firstname & lastname more than 3 chars";
    }
    else if(!preg_match("/^[a-zA-z]*$/", $firstname))
    {
      $registerError = "Firstname contain letters only";
    }
    else if(!preg_match("/^[a-zA-z]*$/", $lastname))
    {
      $registerError = "Lastname contain letters only";
    }
    else if(!preg_match("/^[0-9{10}]*$/", $mobile))
    {
      $registerError = "Invalid Mobile";
    }
    else if(strlen($address) < 5)
    {
      $registerError = "Address should be more than 5 chars";
    }
    else
    {
      $query = "UPDATE registration SET firstname='$firstname', lastname='$lastname', mobile='$mobile', alternate='$alternate', address='$address' WHERE email='$user_email';";
      if(mysqli_query($conn, $query))
      {
        header('location: myaccount.php');
        exit();
      }
    }
  }
}
else {
  header('location: index.php');
  exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit profile</title>

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
        <div class="col-md-6" style="margin-bottom:50px;">
          <h1 style="text-align:center;margin:50px auto;">Profile</h1>
          <form action="" method="post">
            <div class="form-group">
              <label>Firstname</label>
              <input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>">
            </div>
            <div class="form-group">
              <label>Lastname</label>
              <input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>">
            </div>
            <div class="form-group">
              <label>Mobile</label>
              <input class="form-control" type="text" name="mobile" value="<?php echo $mobile; ?>">
            </div>
            <div class="form-group">
              <label>Alternate mobile</label>
              <input class="form-control" type="text" name="alternate" value="<?php echo $alternate; ?>">
            </div>
            <div class="form-group">
              <label>Address</label>
              <input class="form-control" type="text" name="addr" value="<?php echo $address; ?>">
            </div>
            <div style="text-align:center;margin-top:35px;">
              <input class="customOrangeBtn" type="submit" name="submit" value="Make Changes">
            </div>
            <div style="text-align:center;margin-top:10px;color:#f00;">
              <?php echo "$registerError"; ?>
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
