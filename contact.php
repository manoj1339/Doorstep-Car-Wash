<?php
session_start();
include_once "includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact us</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>
    <div id="contactPageSection">
      <div class="titleHead">
        <h1>Contact us</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="contactCard">
              <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
              <h5>7028133123</h5>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contactCard">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <h5>info@carecarz.com</h5>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contactCard">
              <i class="fa fa-location-arrow" aria-hidden="true"></i>
              <h5>Carecarz, Aurangabad</h5>
            </div>
          </div>
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
