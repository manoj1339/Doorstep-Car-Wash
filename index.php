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
  <meta name="description" content="Car washing at your doorstep in Aurangabad! Great quality car wash to shine your car. Car wash starts from just Rs.99" />
  <meta name="keywords" content="car wash, car wash at doorstep, car wash at doorstep in aurangabad, car waxing, vacuum cleaning, car wash nearme, car wash nearby, foam wash" />
  <title>CareCarz | Car wash at your doorstep in Aurangabad!</title>
  <meta name="google-site-verification" content="Y5C824lM5lVUu4pPlra7Jh8IiRnw4HbH2dOaF0JWHP0" />

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
  <meta name="google-site-verification" content="MGZB-IC8wx9INW3HeGYIS2rGp_1uRP_ffaOaIiEZ260" />
</head>
<body>
  <div id="bodyWrapper">
    <?php include_once "includes/header.php"; ?>

    <section id="heroSection">
      <div id="transparentBG"></div>
      <div class="center">
        <h1>Car Washing</h1>
        <h3>At your Doorstep</h3>
        <h2>In Aurangabad City</h2>
        <form action="getACall.php" method="post" autocomplete="off">
          <input type="tel" name="mobNo" placeholder="Enter Your mobile number"/><br/>
          <input class="customBlueBtn" type="submit" name="submit" value="Request A Call" />
        </form>
        <!-- <h4 style="color:#fff;">Starting from <span>14th March 2019</span></h4> -->
      </div>
    </section>

    <section id="serviceSection">
      <div class="titleHead">
        <h1>We Provide</h1>
        <img src="images/wrench.png" alt="image">
      </div>

      <div class="container" style="max-width:960px">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="cardIcon">
              <img src="images/trust.png" alt="trust">
            </div>
            <h4 class="serviceHead">Trust</h4>
            <div class="desc">
              We aspire to provide the best for
              your vehicle to keep it clean with and
              build trust which keeps us running.
              We believe in a transparent process providing.
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="cardIcon">
              <img src="images/conv.png" alt="trust">
            </div>
            <h4 class="serviceHead">Convenience</h4>
            <div class="desc">
              Simply select your desired service location
              through website or mobile, be it your office, your home.
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="cardIcon">
              <img src="images/responsibility.png" alt="trust">
            </div>
            <h4 class="serviceHead">Responsibility</h4>
            <div class="desc">
              We take almost care of your vehicle washing at your doorstep.
              For any problem you can call or mail us.
              we take the complete responsibility of your beloved vehicle.
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="cardIcon">
              <img src="images/badge.png" alt="trust">
            </div>
            <h4 class="serviceHead">Quality</h4>
            <div class="desc">
              Top-notch professional technicians with years of experience
              looking after your vehicle.
              Use of 100% genuine products used for car cleaning.
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="workSection">
      <div class="titleHead">
        <h1>Services</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container" style="max-width: 960px;">
        <div class="row">

          <div class="col-sm-6 serviceImageCard">
            <div class="serviceImage">
              <img src="images/foam.jpg" alt="Foam Wash">
              <div class="serviceImageTag">Foam Wash</div>
            </div>
          </div>
          <div class="col-sm-6 serviceImageCard">
            <div class="serviceImage">
              <img src="images/vaccum.jpg" alt="Vacuum Cleaning">
              <div class="serviceImageTag">Vacuum Cleaning</div>
            </div>
          </div>
          <div class="col-sm-6 serviceImageCard">
            <div class="serviceImage">
              <img src="images/interior.jpg" alt="Interior Cleaning">
              <div class="serviceImageTag">Interior Clean</div>
            </div>
          </div>
          <div class="col-sm-6 serviceImageCard">
            <div class="serviceImage">
              <img src="images/wax.jpg" alt="Waxing of car">
              <div class="serviceImageTag">Wax</div>
            </div>
          </div>

        </div>
        <div class="seemore">
          <a class="customBlueBtn" href="services.php">See more<i style="margin-left: 5px;" class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </section>

    <section id="whyChooseUs">
      <div class="container">
        <h2>Why Choose Us</h2>
        <div class="row">
          <div class="col-md-4">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <h4>Convenient</h4>
            <p>
              Book from anywhere through our website or mobile number.
              Your don't have to waste your time at washing centers.
              Our van will come to your home/office for washing & many other services.
            </p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-eye" aria-hidden="true"></i>
            <h4>Transparent</h4>
            <p>
              Fair pricing for service we do. We use
              top branded car care products. All washing
              of vehicle is done infront of your eyes.
              Best cleaning of your car ever!.
            </p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-money" aria-hidden="true"></i>
            <h4>Economical</h4>
            <p>
              We charge what we do. No extra hidden charges.
              Our rates are cheaper than the washing centers
               because we don't have shop to maintain.
              Best car cleaning at your doorstep.
              After all its 'Money' that counts.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="ecoWashSection">
      <div class="titleHead">
        <h1>Eco Wash</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div style="box-shadow:0px 0px 15px #777;">
              <img src="images/waterless.jpg" alt="Waterless car wash & wax" style="height:100%;width:100%;">
            </div>
          </div>
          <div class="col-md-6">
            <p style="margin-top:1rem;">
              <b>Eco wash</b> is waterless car wash which saves lots of water.
              In <b>Eco wash</b> a chemical which contains carnauba wax is added into half litre of water in spray bottle
              and sprayed onto car & wipe out with microfibre towel.
            </p>
            <p>
              The waterless car wash chemical when sprayed on surface lift
              the dirt particles up and we can easily wipe them out. It not only clean your car but also shines it.
              It does not scratch your paint. It is 100% safe to use.
            </p>
            <ul style="list-style-position:inside;">
              <li>Hatchback, Sedan-<b>&#8377; 99</b></li>
              <li>SUV-<b>&#8377; 130</b></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="oneTimePrice">
      <div class="titleHead">
        <h1>One Time Wash</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container" style="max-width: 1140px;">
        <div class="row">
          <div class="col-md-4 cardParent">
            <div class="priceCardWrapper frontside">
              <div class="priceCardHeader">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                <h2>Basic</h2>
              </div>
              <div class="priceCategory">
                <p>Hatchback, Sedan</p>
                <h1> &#8377; 99</h1>
                <p>SUV</p>
                <h1> &#8377; 149</h1>
              </div>
              <div class="detailPricing">
                <a href="#" class="backflipBtn" data-id="1">
                  Details<i class="fa fa-angle-right" style="margin-left:5px;font-size:18px;" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="backside">
              <ul>
                <li>Exterior wash</li>
                <li>Vacuum cleaning</li>
              </ul>
              <a href="booking.php">Book now</a>
              <p>
                Requirements from you: <br/>
                1. Enough parking space<br/>
                2. Power supply for pressure washer & vacuum<br/>
                (Don't worry! It will not cost you more than half unit)
              </p>

            </div>
          </div>
          <div class="col-md-4 cardParent">
            <div class="priceCardWrapper frontside">
              <div class="priceCardHeader">
                <i class="fa fa-plane" aria-hidden="true"></i>
                <h2>Standard</h2>
              </div>
              <div class="priceCategory">
                <p>Hatchback, Sedan</p>
                <h1> &#8377; 249</h1>
                <p>SUV</p>
                <h1> &#8377; 299</h1>
              </div>
              <div class="detailPricing">
                <a href="#" class="backflipBtn" data-id="2">
                  Details<i class="fa fa-angle-right" style="margin-left:5px;font-size:18px;" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="backside">
              <ul>
                <li>Exterior wash</li>
                <li>Foam wash</li>
                <li>Mats cleaning</li>
                <li>Vacuum cleaning</li>
                <li>Dashboard & Tyre polish</li>
              </ul>
              <a href="booking.php">Book now</a>
              <p>
                Requirements from you: <br/>
                1. Enough parking space<br/>
                2. Power supply for pressure washer & vacuum<br/>
                (Don't worry! It will not cost you more than half unit)
              </p>

            </div>
          </div>
          <div class="col-md-4 cardParent">
            <div class="priceCardWrapper frontside">
              <div class="priceCardHeader">
                <i class="fa fa-rocket" aria-hidden="true"></i>
                <h2>Premium</h2>
              </div>
              <div class="priceCategory">
                <p>Hatchback, sedan</p>
                <h1> &#8377; 349</h1>
                <p>SUV</p>
                <h1> &#8377; 399</h1>
              </div>
              <div class="detailPricing">
                <a href="#" class="backflipBtn" data-id="3">
                  Details<i class="fa fa-angle-right" style="margin-left:5px;font-size:18px;" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="backside">
              <ul>
                <li>Exterior wash</li>
                <li>Foam wash</li>
                <li>Vacuum cleaning</li>
                <li>Mats cleaning</li>
                <li>Dashboard & Tyre polish</li>
                <li>Body wax</li>
              </ul>
              <a href="booking.php">Book now</a>
              <p>
                Requirements from you: <br/>
                1. Enough parking space<br/>
                2. Power supply for pressure washer & vacuum<br/>
                (Don't worry! It will not cost you more than half unit)
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="priceSection">
      <div class="titleHead">
        <h1>Monthly Packs</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container" style="max-width: 1140px;">
        <div class="row">
          <div class="col-md-4 cardParent">
            <div class="priceCardWrapper frontside">
              <div class="priceCardHeader">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                <h2>Basic</h2>
              </div>
              <div class="priceCategory">
                <p>Hatchback, Sedan</p>
                <h1> &#8377; 699</h1>
                <p>SUV</p>
                <h1> &#8377; 899</h1>
                <p>**Register to get pack</p>
              </div>
              <div class="detailPricing">
                <a href="#" class="backflipBtn" data-id="1">
                  Details<i class="fa fa-angle-right" style="margin-left:5px;font-size:18px;" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="backside">
              <ul>
                <li>Exterior wash 10X</li>
                <li>Foam wash 4X</li>
                <li>Vacuum cleaning 2X</li>
                <li>Total 10 visits</li>
              </ul>
              <p>
                Requirements from you: <br/>
                1. Enough parking space<br/>
                2. Power supply for pressure washer & vacuum<br/>
                (Don't worry! It will not cost you more than half unit)
              </p>
            </div>
          </div>
          <div class="col-md-4 cardParent">
            <div class="priceCardWrapper frontside">
              <div class="priceCardHeader">
                <i class="fa fa-plane" aria-hidden="true"></i>
                <h2>Standard</h2>
              </div>
              <div class="priceCategory">
                <p>Hatchback, Sedan</p>
                <h1> &#8377; 999</h1>
                <p>SUV</p>
                <h1> &#8377; 1199</h1>
                <p>**Register to get pack</p>
              </div>
              <div class="detailPricing">
                <a href="#" class="backflipBtn" data-id="2">
                  Details<i class="fa fa-angle-right" style="margin-left:5px;font-size:18px;" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="backside">
              <ul>
                <li>Exterior wash 10X</li>
                <li>Foam wash 4X</li>
                <li>Vacuum cleaning 4X</li>
                <li>Dashboard & tyre polish 4X</li>
                <li>Total 10 visits</li>
              </ul>
              <p>
                Requirements from you: <br/>
                1. Enough parking space<br/>
                2. Power supply for pressure washer & vacuum<br/>
                (Don't worry! It will not cost you more than half unit)
              </p>
            </div>
          </div>
          <div class="col-md-4 cardParent">
            <div class="priceCardWrapper frontside">
              <div class="priceCardHeader">
                <i class="fa fa-rocket" aria-hidden="true"></i>
                <h2>Premium</h2>
              </div>
              <div class="priceCategory">
                <p>Hatchback, Sedan</p>
                <h1> &#8377; 1199</h1>
                <p>SUV</p>
                <h1> &#8377; 1399</h1>
                <p>**Register to get pack</p>
              </div>
              <div class="detailPricing">
                <a href="#" class="backflipBtn" data-id="3">
                  Details<i class="fa fa-angle-right" style="margin-left:5px;font-size:18px;" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="backside">
              <ul>
                <li>Exterior wash 10X</li>
                <li>Foam wash 4X</li>
                <li>Vacuum cleaning 4X</li>
                <li>Dashboard & tyre polish 4X</li>
                <li>Body Wax 1X</li>
                <li>Total 10 visits</li>
              </ul>
              <p>
                Requirements from you: <br/>
                1. Enough parking space<br/>
                2. Power supply for pressure washer & vacuum<br/>
                (Don't worry! It will not cost you more than half unit)
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="howItWorks">
      <div class="titleHead">
        <h1>How it works</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="howitCard">
              <div class="howitIcon">
                <i class="fa fa-desktop" aria-hidden="true"></i>
              </div>
              <h4>Book or Call us</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="howitCard">
              <div class="howitIcon">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
              </div>
              <h4>Give your details</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="howitCard">
              <div class="howitIcon">
                <i class="fa fa-car" aria-hidden="true"></i>
              </div>
              <h4>Our Van will come to your home</h4>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="brandSection">
      <div class="container" style="max-width:960px;">
        <div class="slidesContainer">
          <div class="slides">
            <div><img src="images/brands/chevrolet.png" alt="chevrolet"></div>
            <div><img src="images/brands/fiat.png" alt="fiat"></div>
            <div><img src="images/brands/ford.png" alt="ford"></div>
            <div><img src="images/brands/honda.png" alt="honda"></div>
          </div>
          <div class="slides">
            <div><img src="images/brands/mahindra.png" alt="mahindra"></div>
            <div><img src="images/brands/maruti.png" alt="maruti"></div>
            <div><img src="images/brands/nissan.png" alt="nissan"></div>
            <div><img src="images/brands/renault.png" alt="renault"></div>
          </div>
          <div class="slides">
            <div><img src="images/brands/skoda.png" alt="skoda"></div>
            <div><img src="images/brands/tata.png" alt="tata"></div>
            <div><img src="images/brands/toyoto.png" alt="toyoto"></div>
            <div><img src="images/brands/volkswagen.png" alt="volkswagen"></div>
          </div>
        </div>
      </div>
    </section>

    <section id="feedbackSection">
      <div class="titleHead">
        <h1>Feedback</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container">
        <form onsubmit="return false;" autocomplete="off">
          <div class="row">
            <div class="col-md-6 inputLabel">
              <input id="feedbackName" type="text" name="name" required />
              <label for="name">Name</label>
            </div>
            <div class="col-md-6 inputLabel">
              <input id="feedbackEmail" type="text" name="email" required />
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 inputLabel">
              <textarea id="feedbackMessage" name="message" rows="4" cols="20" required></textarea>
              <label for="message">Message</label>
              <input type="submit" value="Submit" onclick="fillFeedback()">
            </div>
            <div id="feedbackError"></div>
          </div>
        </form>
      </div>
    </section>

    <section id="phoneNoSection">
      <h1>Call Now On <a href="tel: 7028133123">7028 133 123</a></h1>
    </section>

  </div>

  <div id="callnowBooknow">
    <div>
      <i class="fa fa-phone" aria-hidden="true"></i>
      <a href="tel: 7028133123">7028133123</a>
    </div>
    <div>
      <i class="fa fa-pencil" aria-hidden="true"></i>
      <a href="booking.php">Book Now</a>
    </div>
  </div>

  <?php include_once "includes/footer.php" ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/debug.addIndicators.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
<script src="js/script.js"></script>
<script>
  var controller = new ScrollMagic.Controller();

  $('.titleHead').each(function(){
    var tween2 = TweenMax.from(this, 0.5, {scale: 0});
    var scene2 = new ScrollMagic.Scene({
      triggerElement: this,
      triggerHook: 0.6
    })
      .setTween(tween2) // trigger a TweenMax.to tween
      .addTo(controller);
  });

  $('.container').each(function(){
    var tween3 = TweenMax.from(this, 2, {opacity: 0});
    var scene3 = new ScrollMagic.Scene({
      triggerElement: this
    })
      .setTween(tween3) // trigger a TweenMax.to tween
      .addTo(controller);
  });
</script>
</body>
</html>
