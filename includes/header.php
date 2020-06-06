<?php
$CarUserName = "";
$CarUserEmail = "";
$loginRegister = "";
$loginTrigger = "";

if(!isset($_SESSION['CarUserEmail']))
{
  $loginRegister = "";
  $loginTrigger = "loginTrigger";
}
else
{
  $CarUserEmail = $_SESSION['CarUserEmail'];

  $user_info = fetch_user_info_profile($conn, $CarUserEmail);
  $loginTrigger = "";
  $CarUserName = $user_info['firstname']." ".$user_info['lastname'];


  $loginRegister = "<ul>
                      <li><a href='myaccount.php'>My Account</a></li>
                      <li><a href='logout.php'>Log Out</a></li>
                    </ul>";
}
?>

<div id="fb-root"></div>
<script async defer src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2"></script>

<!-- Loader -->
<div id="loaderContainer">
  <div id="loader">
    <div class="spinner"></div>
  </div>
</div>

<header>
  <div id="topNav">
    <div id="email">
      <i class="fa fa-envelope" aria-hidden="true"></i>
      info@carecarz.com
    </div>
    <div id="phone">
      <i class="fa fa-phone" aria-hidden="true"></i>
      7028133123
    </div>
  </div>

  <div id="navClearfix">
    <div id="navBar">
      <div id="logo">
        <a href="index.php"><img src="images/logo14.png" alt="Logo"></a>
      </div>
      <i id="toggleNav" class="fa fa-bars" aria-hidden="true"></i>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="offers.php">Offers</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li><a class="customBlueBtn" href="booking.php">Book Now</a></li>
        <li>
          <a id='<?php echo "$loginTrigger"; ?>' href="#">
            <i class="fa fa-user-circle" aria-hidden="true"></i><br/>
            <span>
              <?php
              if($CarUserName == ""){
                echo "Login / Register";
              }
              else {
                echo "$CarUserName";
              }
              ?>
            </span>
          </a>
          <?php echo "$loginRegister"; ?>
        </li>
      </ul>
    </div>
  </div>
</header>
