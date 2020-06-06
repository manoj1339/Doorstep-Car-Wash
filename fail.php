
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Transaction Failed</title>

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
      <div class="col-md-6">
        <img style="display:block;height:100px;width:100px;margin:50px auto 0 auto;" src='images/cancel.png' alt='cancel' />
        <h2 style='text-align:center;'>Oops !</h2>
        <h6 style='margin-bottom: 16px;text-align:center; color:#aaa;'>Something went wrong</h6>
        <p style="text-align:center;">
        <?php
        if(isset($_POST['status']))
        {
          echo "Error : ".$_POST['unmappedstatus'];
        }
        ?>
        </p>
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
