<?php
session_start();
include_once "includes/db.php";

$output = "";
if(isset($_SESSION['CarUserEmail']))
{
  $user_email = user_input($_SESSION['CarUserEmail']);
  $user_account_info = fetch_user_info_profile($conn, $user_email);

  if(isset($_GET['plan']))
  {
    $plan = user_input($_GET['plan']);

    $sql = "SELECT * FROM bookpackage WHERE email='$user_email' AND status='activated';";
    $sql_result = mysqli_query($conn, $sql);
    $entries = mysqli_num_rows($sql_result);

    if($entries > 0)
    {
      $output = "
           <div style='margin-top:4rem;text-align:center;'>
             <h3>You are already subscribed to plan.</h3>
             <a href='myaccount.php'>Go Back</a>
           </div>
      ";
    }
    else
    {
      $user_model = $user_account_info['model'];
      $user_brand = $user_account_info['brand'];
      $vehicleType = "";
      $charges = 0;

      $sql = "SELECT * FROM model WHERE model='$user_model' AND brand='$user_brand';";
      $sql_result = mysqli_query($conn, $sql);

      if($sql_result)
      {
        while($row = mysqli_fetch_assoc($sql_result))
        {
          $vehicleType = $row['vehicleType'];
        }
      }

      if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $plan == 'Basic')
      {
        $charges = 699;
      }
      else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $plan == 'Standard')
      {
        $charges = 999;
      }
      else if(($vehicleType == 'hatchback' || $vehicleType == 'sedan') && $plan == 'Premium')
      {
        $charges = 1199;
      }
      else if($vehicleType == 'suv' && $plan == 'Basic')
      {
        $charges = 899;
      }
      else if($vehicleType == 'suv' && $plan == 'Standard')
      {
        $charges = 1199;
      }
      else if($vehicleType == 'suv' && $plan == 'Premium')
      {
        $charges = 1399;
      }

      $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

      $query = "INSERT INTO bookpackage (email, plan, planvisit, plancharge, datemade, dateexpire, txn_id, status) VALUES ('$user_email', '$plan', 0, '$charges', '$now', DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '$txnid', 'deactivated');";
      $result = mysqli_query($conn, $query);

      if($result)
      {
        header('location: formprocess2.php?email='.$user_email.'&txn_id='.$txnid);
        exit();
      }
      else
      {
        $output = "<div style='margin-top:4rem;text-align:center;'>
          Something went wrong
        </div>";
      }
    }

  }
  else if (isset($_GET['action']))
  {
    $action = user_input($_GET['action']);
    $query = "DELETE FROM bookpackage WHERE email='$user_email' AND status='activated';";
    $result = mysqli_query($conn, $query);

    if($result)
    {
      header('location: myaccount.php');
      exit();
    }
  }
  else
  {
      header('location: index.php');
      exit();
  }

}
else
{
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
  <title>Pack subscribe</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
  <div id="bodyWrapper">
  <?php include_once "includes/header.php"; ?>

  <?php echo "$output"; ?>
  </div>

  <?php include_once "includes/footer.php"; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
