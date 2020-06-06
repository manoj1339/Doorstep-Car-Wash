<?php
include_once "includes/db.php";

if(isset($_POST['pwd']))
{
  $pwd = user_input($_POST['pwd']);
  $cpwd = user_input($_POST['cpwd']);
  $email = user_input($_POST['email']);

  if(empty($pwd) || empty($cpwd) || empty($email))
  {
    echo "<span style='color:#f00;'>Please check your inputs</span>";
  }
  else if (strlen($pwd) < 5 || strlen($cpwd) < 5)
  {
    echo "<span style='color:#f00;'>Password length should be atleast 6 chars</span>";
  }
  else if($pwd != $cpwd) {
    echo "<span style='color:#f00;'>Both fields should match</span>";
  }
  else
  {
    $query = "UPDATE registration SET password='$pwd' WHERE email='$email' LIMIT 1;";
    $result = mysqli_query($conn, $query);

    if($result)
    {
      $sql = "UPDATE registration SET token=null WHERE email='$email' LIMIT 1;";
      mysqli_query($conn, $sql);
      echo '<span style="color:#428742;">Your password reset successfully. Go to login</span>';
    }
  }
}
else
{
  header('location: index.php');
  exit();
}
?>
