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
  <title>About us</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>
    <section id="aboutPageSection">
      <div class="titleHead">
        <h1>About us</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="aboutUs">
        <img src="images/bg2.jpg" alt="carwash" />
        <p>
          Carecarz.com is a project started by our group of friends to
          give washing services at your doorstep in Aurangabad city.
          In day to day life peoples are too busy in thier work, job.
          They don't have enough time to get their car serviced or washed by
          going to service, washing centers. So we come up with an idea that
          we can provide washing services to customers right at their doorstep.
        </p>
        <p>
          We have fully equipped van with our one technician who will
          wash your car. You will only need enough parking space for car.
          We not only provide wash but also various car
          detailing services such as foam wash, vacuum cleaning, leather seat cleaning,
          wax, glass cleaning etc. If your car is too dirty then Don't forget to
          book our services. It's very easy, reliable and convenient. THANK YOU for visit!
        </p>
      </div>
    </section>

  </div>
  <?php include_once "includes/footer.php" ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="js/script.js"></script>

</body>
</html>
