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
  <title>Products</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>
    <section style="padding-bottom:4rem;">
      <div class="titleHead">
        <h1>Products we use</h1>
        <img src="images/wrench.png" alt="image">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4" style="margin-top:3.5rem;">
            <iframe style="width:120px;height:240px;margin:0 auto;display:block;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-in.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=IN&source=ac&ref=tf_til&ad_type=product_link&tracking_id=offersbazar09-21&marketplace=amazon&region=IN&placement=B01CBJ50VQ&asins=B01CBJ50VQ&linkId=79a3f377e07435799b9f62e75b2a8e4e&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
            </iframe>
          </div>
          <div class="col-md-4" style="margin-top:3.5rem;">
            <iframe style="width:120px;height:240px;margin:0 auto;display:block;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-in.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=IN&source=ac&ref=tf_til&ad_type=product_link&tracking_id=offersbazar09-21&marketplace=amazon&region=IN&placement=B0060HVCEU&asins=B0060HVCEU&linkId=587769241553b2d8aa1c6f45363b3257&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
            </iframe>
          </div>
          <div class="col-md-4" style="margin-top:3.5rem;">
            <iframe style="width:120px;height:240px;margin:0 auto;display:block;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-in.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=IN&source=ac&ref=tf_til&ad_type=product_link&tracking_id=offersbazar09-21&marketplace=amazon&region=IN&placement=B01LZ3TGL2&asins=B01LZ3TGL2&linkId=9dfc9d520441435a3f9f00e2fef74eda&show_border=false&link_opens_in_new_window=false&price_color=333333&title_color=0066c0&bg_color=ffffff">
            </iframe>
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
