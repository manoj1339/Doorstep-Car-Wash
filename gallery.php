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
  <title>Gallery</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="style/style.css">
  <style>

.flexbox {
  display: -webkit-flex;
  display: flex;
  -webkit-flex-direction: column;
  flex-direction: column;
  -webkit-flex-wrap: wrap;
  flex-wrap: wrap;
  height: 100vw;
}
.flexbox:hover img {
  opacity: 0.28;
}
.flexbox .item {
  position: relative;
  width: 33.33%;
}
.flexbox .item img {
  width: 100%;
  display: block;
  transition: all .8s;
}
.flexbox .item .title {
  position: absolute;
  top: 48%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 100%;
  padding: 0 3%;
  font-size: 30px;
  font-style: bold;
  text-shadow: 0 0 8px rgba(0, 0, 0, 0.42);
  color: #ff0f0f;
  transition: all 0.3s;
}
.flexbox .item:hover img {
  opacity: 1;
}

.flexbox .item:hover .title {
  top: 10px;
  font-size: 25px;
}

@media (max-width: 860px) {
  .flexbox {
    height: 220vw;
  }
  .flexbox .item {
    width: 50%;
  }
}
@media (max-width: 667px) {
  .flexbox {
    height: auto;
  }
  .flexbox .item {
    width: 100%;
  }
}

  </style>
</head>
<body>

  <div id="bodyWrapper">
    <?php include_once "includes/header.php" ?>

    <div class="titleHead">
      <h1>Photos</h1>
      <img src="images/wrench.png" alt="image">
    </div>
    
    <div class="flexbox">
      <div class="item">
        <img src="images/bg2.jpg" />
        <p class="title">Our Van</p>
      </div>
      <div class="item">
        <img src="images/1.jpg" />
        <p class="title">Foam wash</p>
      </div>
      <div class="item">
        <img src="images/2.jpg" />
        <p class="title">Before Wash</p>
      </div>
      <div class="item">
        <img src="images/3.jpg" />
        <p class="title">After wash</p>
      </div>
      <div class="item">
        <img src="images/4.jpg" />
        <p class="title">Exterior wash</p>
      </div>
      
    </div>
  </div>

  <?php include_once "includes/footer.php" ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="js/script.js"></script>

</body>
</html>
