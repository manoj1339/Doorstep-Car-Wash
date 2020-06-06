<?php
include_once 'includes/db.php';
session_start();

$loginError = '';
if(isset($_POST['userNumber']))
{
  $userNumber = user_input($_POST['userNumber']);
  $userPwd = user_input($_POST['userPwd']);
  $session = "";

  if($userNumber=="" || $userPwd=="")
  {
    $loginError = "Please fill all fields";
  }
  else
  {
    $query = "SELECT * FROM registration WHERE email='$userNumber' AND status='1' LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if($rows > 0)
    {
      while ($row_data = mysqli_fetch_assoc($result))
      {
        $hashed_password = $row_data['password'];
        $session = $row_data['email'];
      }
      if(password_verify($userPwd, $hashed_password))
      {
        $_SESSION['CarUserEmail'] = $session;
        $loginError = 'success';
      }
      else
      {
        $loginError = 'Wrong password';
      }
    }
    else
    {
      $loginError = "Email not registered";
    }
  }
  echo "$loginError";
}
