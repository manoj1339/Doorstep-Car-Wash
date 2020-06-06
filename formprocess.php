<?php
include_once "includes/db.php";

if(isset($_GET['txn_id']))
{
  $txnid = user_input($_GET['txn_id']);
  $user_email = user_input($_GET['email']);
  $MERCHANT_KEY = "CZHoGuHH";
  $SALT = "YjLTIxzyuw";
  $hash = "";
  $amount = "";
  $firstname = "";
  $lastname = "";
  $user_mobile = "";
  $product_info = "";
  $address = "";
  $brand = "";
  $vehicle_model = "";
  $vehicle_no = "";
  $service_provider = "CareCarz";
  $waxing = '';
  $surl = "https://www.carecarz.com/thankyou.php";
  $furl = "https://www.carecarz.com/fail.php";

  $query = "SELECT * FROM booking WHERE txn_id='$txnid' AND email='$user_email' LIMIT 1;";
  $result = mysqli_query($conn, $query);
  $result_rows = mysqli_num_rows($result);

  if($result_rows > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $amount = $row['charges'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $user_mobile = $row['mobile'];
      $product_info = $row['service'];
      $address = $row['address'];
      $brand = $row['brand'];
      $vehicle_model = $row['model'];
      $vehicle_no = $row['vehicleno'];
      $waxing = $row['waxing'];
    }

    $hash_string = $MERCHANT_KEY. "|".$txnid."|".$amount."|".$product_info."|".$firstname."|".$user_email."|".$user_email."|".$user_mobile."|".$lastname."|".$address."|".$brand."|".$vehicle_model."|".$vehicle_no."|".$waxing."|||".$SALT;
    $hash = strtolower(hash('sha512', $hash_string));
  }
  else
  {
    header('location: fail.php');
    exit();
  }
}
else
{
  header('location: booking.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Processing</title>
 <script>
    function submitForm() {
      var postForm = document.forms.postForm;
      postForm.submit();
    }
</script>
<link rel="shortcut icon" href="images/icon.png" />
</head>
<body onload="submitForm();">

  <form name="postForm" action="https://secure.payu.in/_payment" method="POST" >
   <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
   <input type="hidden" name="hash" value="<?php echo $hash;  ?>"/>
   <input type="hidden" name="txnid" value="<?php echo $txnid;  ?>" />
   <input type="hidden" name="amount" value="<?php echo $amount;  ?>" />
   <input type="hidden" name="firstname" value="<?php echo $firstname;  ?>" />
   <input type="hidden" name="lastname" value="<?php echo $lastname;  ?>" />
   <input type="hidden" name="email" value="<?php echo $user_email;  ?>" />
   <input type="hidden" name="phone" value="<?php echo $user_mobile;  ?>" />
   <input type="hidden" name="udf1" value="<?php echo $user_email;  ?>" />
   <input type="hidden" name="udf2" value="<?php echo $user_mobile;  ?>" />
   <input type="hidden" name="udf3" value="<?php echo $lastname;  ?>" />
   <input type="hidden" name="udf4" value="<?php echo $address;  ?>" />
   <input type="hidden" name="udf5" value="<?php echo $brand;  ?>" />
   <input type="hidden" name="udf6" value="<?php echo $vehicle_model;  ?>" />
   <input type="hidden" name="udf7" value="<?php echo $vehicle_no;  ?>" />
   <input type="hidden" name="udf8" value="<?php echo $waxing;  ?>" />
   <input type="hidden" name="productinfo" value="<?php echo $product_info;  ?>" />
   <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
   <input type="hidden" name="surl" value="<?php echo $surl;  ?>" />
   <input type="hidden" name="furl" value="<?php echo $furl;  ?>" />
  </form>

</body>

</html>
