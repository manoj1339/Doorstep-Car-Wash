<?php
include_once "includes/db.php";

if(isset($_POST['brand']))
{
  $brand = user_input($_POST['brand']);
  $model = user_input($_POST['model']);
  $service = user_input($_POST['service']);
  $waxing = user_input($_POST['waxing']);

  $query = "SELECT * FROM model WHERE brand='$brand' AND model='$model';";
  $result = mysqli_query($conn, $query);
  $result_rows = mysqli_num_rows($result);

  $wax = 0;
  $charges = 0;
  $discount = 0;
  $total = 0;

  if($result_rows > 0)
  {
    while($row = mysqli_fetch_assoc($result))
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

    $html = '
    <tr>
      <th>Pack price</th>
      <td>&#8377; '.$charges.'</td>
    </tr>
    <tr>
      <th>Wax(Add-on)</th>
      <td>&#8377; '.$wax.'</td>
    </tr>
    <tr>
      <th>Discount</th>
      <td>&#8377; '.$discount.'</td>
    </tr>
    <tr style="background: #c73000;color: #fff;">
      <th>Total</th>
      <td>&#8377; '.$total.'</td>
    </tr>
    ';

    echo "$html";

  }
}
else{
  header("location: index.php");
  exit();
}
?>
