<?php
session_start();
include_once "includes/db.php";

function checkmydate($date)
{
  $tempDate = explode('-', $date);
  // checkdate(month, day, year)
  return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
}

if(isset($_POST['first']))
{
  $email = user_input($_SESSION['CarUserEmail']);
  $first = user_input($_POST['first']);
  $second = user_input($_POST['second']);
  $third = user_input($_POST['third']);
  $fourth = user_input($_POST['fourth']);

  if(empty($email) || empty($first) || empty($second) || empty($third)|| empty($fourth))
  {
    echo "Please fill all fields";
  }
  else if(!(checkmydate($first) && checkmydate($second) && checkmydate($third) && checkmydate($fourth))){
    echo "Enter valid date format";
  }
  else
  {
    $sql = "SELECT * FROM datesforpackage WHERE email='$email';";
    $rslt = mysqli_query($conn, $sql);
    $rslt_rows = mysqli_num_rows($rslt);

    if($rslt_rows > 0)
    {
      $query = "UPDATE datesforpackage SET first='$first', second='$second', third='$third', fourth='$fourth' WHERE email='$email';";
      if(mysqli_query($conn, $query))
      {
        echo "<span style='color:#428742;'>Dates updated successfully !</span>";
      }
      else
      {
        echo "Please try later";
      }
    }
  }

}
else
{
  header('location: index.php');
  exit();
}
?>
