<?php
session_start();
include_once "includes/db.php";

if(isset($_POST['submit']))
{
  $admin = user_input($_POST['admin']);
  $pass = user_input($_POST['pass']);

  if($admin == 'carecarz' && $pass == 'carecarz3406')
  {
    $_SESSION['adminLogin'] = 'carecarz';
    header('location: admindashboard.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Login</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
  <div class="container">
    <div style="max-width: 400px;margin: 5rem auto 0 auto;">
      <form action="" method="post">
        <div style="text-align:center;margin-top:1rem;">
          <img src="images/logo14.png" alt="logo" style="width: 160px;" />
        </div>
        <div style="text-align:center;margin-top:1rem;">
          <input type="text" name="admin" placeholder="Admin" />
        </div>
        <div style="text-align:center;margin-top:1rem;">
          <input type="text" name="pass" placeholder="Password" />
        </div>
        <div style="text-align:center;margin-top:1rem;">
          <input type="submit" name="submit" value="Login" />
        </div>
      </form>
    </div>
  </div>
</body>
</html>
