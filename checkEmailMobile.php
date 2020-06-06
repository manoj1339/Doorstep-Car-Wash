<?php
include_once 'includes/db.php';

if(isset($_REQUEST['registerEmail']))
{
  $email = user_input($_REQUEST['registerEmail']);

  $query = "SELECT * FROM registration WHERE email='$email';";
  $result= mysqli_query($conn, $query);
  $result_rows = mysqli_num_rows($result);

  if($result_rows > 0)
  {
    echo "false";
  }
  else {
    echo "true";
  }

}
else if(isset($_REQUEST['registerMob']))
{
  $mob = user_input($_REQUEST['registerMob']);

  $query = "SELECT * FROM registration WHERE mobile='$mob';";
  $result= mysqli_query($conn, $query);
  $result_rows = mysqli_num_rows($result);

  if($result_rows > 0)
  {
    echo "false";
  }
  else {
    echo "true";
  }
}
else
{
  header('location: index.php');
  exit();
}
?>
