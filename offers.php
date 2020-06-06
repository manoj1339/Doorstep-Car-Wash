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
  <title>Offers</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
  <style>
  .coupon
  {
    border: 5px dotted #bbb;
    width: 100%;
    border-radius: 15px;
    max-width: 600px;
    margin: 0 auto;
  }

  .box
  {
    padding: 2px 16px;
    background-color: #f1f1f1;
  }

  .promo
  {
    background: #ccc;
    padding: 3px;
  }

  .expire
  {
    color: red;
    margin-top: 1rem;
  }
  </style>
</head>
<body>

  <div id="bodyWrapper">

    <?php include_once "includes/header.php" ?>
    <section id="aboutPageSection">
      <div class="titleHead">
        <h1>Offers</h1>
        <img src="images/wrench.png" alt="image">
      </div>
    </section>

    <div class="container" style="margin-bottom: 30px;">
      <div class="row justify-content-center">
        <div>
          <div class="coupon">
            <div class="box">
              <img src="https://www.carecarz.com/images/logo14.png" alt="logo" style="width:100px;" />
            </div>
            <img src="https://www.carecarz.com/images/foam.jpg" alt="Foam wash" style="width:100%;" />
            <div class="box" style="background-color:white;padding: 1.5rem 1rem;">
              <h2 style="margin-bottom: 1.5rem"><b>&#x20B9; 50 OFF ON BOOKING</b></h2>
              <p>Get 50 rupees off on your booking.
                This offer is applicable on Standard and Premium one time washes.
                You can make payment online or by cash.
              </p>
              <p>
              This offer doesn't include Eco wash and monthly packs.
              </p>
            </div>
            <div class="box">
              <p class="expire">Offer expires on: Mar 16, 2019</p>
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
