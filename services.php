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
  <title>Our Services</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>
    <section id="servicePageSection">
      <div class="titleHead">
        <h1>Our Services</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container">
        <span>Foam Wash</span>
        <div class="row">
          <div class="col-md-6">
            <img src="images/foam.jpg" alt="Foam">
          </div>
          <div class="col-md-6">
            <p>
              Clean your car with powerful snow! Snow Foam is the first
              auto shampoo specifically designed to create copious amounts of
              cleaning suds in a foam cannon or foam gun. ...
              Traditional wash methods push dirt around on painted surfaces,
              inducing wash & dry scratches and marring marks that rob your car of shine.
            </p>
          </div>
        </div>
        <span>Vacuum Cleaning</span>
        <div class="row">
          <div class="col-md-6">
            <p>
              car vacuum that is excellent at removing stubborn dirt and stains from carpet and other car upholstery.
               It is a compact vacuum cleaner that combines a powerful suction,
               tough scrubbing and cleaning solution for excellent result,
                which is perfect for car detailing.
            </p>
          </div>
          <div class="col-md-6">
            <img src="images/vaccum.jpg" alt="Vacuum">
          </div>
        </div>
        <span>Interior Clean</span>
        <div class="row">
          <div class="col-md-6">
            <img src="images/interior.jpg" alt="Interior">
          </div>
          <div class="col-md-6">
            <p>
              Outer beauty is nothing compared to inner beauty.
              Therefore, it comes as no surprise that interior car detailing requires more effort and time than
              exterior detailing. A dirty interior cabin not only has a bad odor,
              but also adds to operational complications.
              Dirty air exhaust spreads allergens about the cabin.
              stain and grit causes switches to fail and hazy windows can obscure the view of a driver.
              In that case, cleaning a car’s interior is more than just washing with water and soap.
            </p>
          </div>
        </div>
        <span>Wax</span>
        <div class="row">
          <div class="col-md-6">
            <p>
              Some people may see a wax job as an extra for their car,
              something you do on special occasions to provide a little extra shine. ...
              And it's not just a cosmetic benefit either,
              regular waxing helps to protect the paint job
              and clear coat on your car by preserving oils in the paint that help to prevent oxidation.
            </p>
          </div>
          <div class="col-md-6">
            <img src="images/wax.jpg" alt="Wax">
          </div>
        </div>
      </div>
    </section>

  </div>
  <?php include_once "includes/footer.php" ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="js/script.js"></script>

</body>
</html>
