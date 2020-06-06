<?php
include_once "includes/db.php";

if(isset($_GET['token']))
{
  $output = "";

  if($_GET['token'] == null)
  {
    header('location: index.php');
    exit();
  }
  else
  {
    $token = user_input($_GET['token']);
    $email = user_input($_GET['email']);

    $query = "SELECT * FROM registration WHERE email='$email' AND token='$token' LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $result_rows = mysqli_num_rows($result);

    if($result_rows > 0)
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $db_token = $row['token'];
      }

      if($token == $db_token)
      {
        $output = '
        <form method="post" onclick="return false;">
          <input id="useremail" type="hidden" value="'.$email.'" />
          <div class="form-group">
            <input id="pwd" class="form-control" type="password" name="pwd" placeholder="Enter password"/>
          </div>
          <div class="form-group">
            <input id="cpwd" class="form-control" type="password" name="cpwd" placeholder="Enter confirm password"/>
          </div>
          <div class="form-group" style="text-align:center;">
            <input class="customOrangeBtn" type="submit" name="submit" value="Submit" onclick="setPassword()" />
          </div>
          <div id="formError" style="text-align:center;">

          </div>
        </form>
        ';
      }
      else
      {
        $output = "Wrong token! we can't process your request";
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reset password</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>

    <div class="container" style="margin-top:5rem;">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div style="text-align: center;">
            <?php echo "$output"; ?>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include_once "includes/footer.php" ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="js/script.js"></script>
  <script type="text/javascript">
  function setPassword(){
    var email = $('#useremail').val();
    var pwd = $('#pwd').val();
    var cpwd = $('#cpwd').val();

    $.ajax({
      method: 'post',
      url: 'setpassword.php',
      data:{pwd:pwd, cpwd:cpwd, email:email},
      success: function(data)
      {
        $('#formError').html(data);
        $('#pwd').val('');
        $('#cpwd').val('');
      }
    });
  }
  </script>

</body>
</html>
