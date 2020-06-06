<?php
session_start();
include_once "includes/db.php";

if(isset($_SESSION['CarUserEmail']))
{
  $user_email = user_input($_SESSION['CarUserEmail']);
  $user_account_info = fetch_user_info_profile($conn, $user_email);
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
  <title><?php echo $user_account_info['firstname']." ".$user_account_info['lastname'] ?></title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  <link rel="stylesheet" href="style/style.css">
</head>
<body>
  <div id="bodyWrapper">
    <?php include_once "includes/header.php"; ?>
    <section id="myAccount">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div id="myAccountOption">
              <img src="<?php echo $user_info['profilephoto']; ?>" alt="user">
              <div>
                <i class="fa fa-user" aria-hidden="true"></i>
                <?php echo $user_account_info['firstname']." ".$user_account_info['lastname']; ?><br/>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span><?php echo $user_account_info['mobile']; ?></span><br/>
                <i class="fa fa-mobile" aria-hidden="true"></i>
                <span><?php echo $user_account_info['alternate']; ?></span>
              </div>
              <div>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <?php echo $user_account_info['email']; ?><br/>
                <i class="fa fa-address-card" aria-hidden="true"></i>
                <span><?php echo $user_account_info['address']; ?></span>
              </div>
              <div>
                <i class="fa fa-car" aria-hidden="true"></i>
                <?php echo $user_account_info['brand']." ".$user_account_info['model']; ?><br/>
                <span><?php echo $user_account_info['vehicleno']; ?></span>
              </div>
              <ul>
                <li><a href="editprofile.php">Edit Profile</a></li>
                <li><a class="btn btn-danger" href="logout.php">Log Out</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-8">
            <div id="myPackagesNSpent" class="flex-box">
              <?php
              $sql = "SELECT * FROM bookpackage WHERE email='$user_email' AND status='activated' LIMIT 1;";
              $visit_result = mysqli_query($conn, $sql);
              $plan = 'No plan';
              $plan_visit = '-';
              $plan_charge = '-';
              $plan_date = '';

              if($visit_result)
              {
                while ($row_data = mysqli_fetch_assoc($visit_result))
                {
                  $plan = $row_data['plan'];
                  $plan_visit = $row_data['planvisit'];
                  $plan_charge = $row_data['plancharge'];
                  $time = strtotime($row_data['datemade']);
                  $end_time = strtotime($row_data['dateexpire']);
                  $plan_date = date("j My", $time)." - ".date("j My", $end_time);
                }
              }
              ?>
              <div>
                <h6>Active Plan</h6>
                <p>
                  <?php
                    echo "$plan" . "<br/>";
                    echo "$plan_date". "<br/>";

                    if($plan != 'No plan' && $plan_charge == 'unpaid'){
                      echo '<a href="subscribe.php?action=drop">Drop</a>';
                    }
                  ?>
                </p>
              </div>
              <div>
                <h6>Payment done</h6>
                <p><?php echo $plan_charge; ?></p>
              </div>
              <div>
                <h6>Plan visits</h6>
                <p><?php echo $plan_visit; ?></p>
              </div>
            </div>
            <div id="myPackageInfo">
              <p>
                Here you can subscribe for monthly packs<br/><br/>
                Your monthly pack details will be shown in the above boxes<br/><br/>
                There are total 10 visits for every pack<br/><br/>
                There will be 2 day gap between two consecutive visits
              </p>
            </div>
          </div>
        </div>



        <div class="row" id="myPackagesDesc">
            <div class="col-md-4">
              <div>
                <div class="washingCardHead">
                  <i class="fa fa-paper-plane" aria-hidden="true"></i>
                  <h3>Basic</h3>
                  <h5>Rs 699/month</h5>
                  <p>(Hatchback,Sedan)</p>
                  <h5>Rs 899/month</h5>
                  <p>(SUV)</p>
                </div>
                <div class="washingCardDesc">
                  <ul>
                    <li>Exterior Wash 10X</li>
                    <li>Foam wash 4X</li>
                    <li>Vacuum cleaning 2X</li>
                    <li>Total 10 visits</li>
                  </ul>
                </div>
                <div class="washingCardBottom">
                  <a href="subscribe.php?plan=Basic">Subscribe</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div>
                <div class="washingCardHead">
                  <i class="fa fa-plane" aria-hidden="true"></i>
                  <h3>Standard</h3>
                  <h5>Rs 999/month</h5>
                  <p>(Hatchback,Sedan)</p>
                  <h5>Rs 1199/month</h5>
                  <p>(SUV)</p>
                </div>
                <div class="washingCardDesc">
                  <ul>
                    <li>Exterior Wash 10X</li>
                    <li>Foam wash 4X</li>
                    <li>Vacuum Cleaning 4X</li>
                    <li>Dashboard & tyre polish 4X</li>
                    <li>Total 10 visits</li>
                  </ul>
                </div>
                <div class="washingCardBottom">
                  <a href="subscribe.php?plan=Standard">Subscribe</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div>
                <div class="washingCardHead">
                  <i class="fa fa-rocket" aria-hidden="true"></i>
                  <h3>Premium</h3>
                  <h5>Rs 1199/month</h5>
                  <p>(Hatchback,Sedan)</p>
                  <h5>Rs 1399/month</h5>
                  <p>(SUV)</p>
                </div>
                <div class="washingCardDesc">
                  <ul>
                    <li>Exterior Wash 10X</li>
                    <li>Foam Wash 4X</li>
                    <li>Vacuum Cleaning 4X</li>
                    <li>Dashboard & tyre polish 4X</li>
                    <li>Body Wax 1X</li>
                    <li>Total 10 visits</li>
                  </ul>
                </div>
                <div class="washingCardBottom">
                  <a href="subscribe.php?plan=Premium">Subscribe</a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>

    <?php
    $query = "SELECT * FROM package_details WHERE email='$user_email' LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);

    if($rows > 0)
    {
      if($result)
      {
        while ($row_info = mysqli_fetch_assoc($result))
        {
          $first_visit = $row_info['first'];
          $second_visit = $row_info['second'];
          $third_visit = $row_info['third'];
          $fourth_visit = $row_info['fourth'];
          $fifth_visit = $row_info['fifth'];
          $sixth_visit = $row_info['sixth'];
          $seventh_visit = $row_info['seventh'];
          $eightth_visit = $row_info['eightth'];
          $nineth_visit = $row_info['nineth'];
          $tenth_visit = $row_info['tenth'];

          echo '
          <section id="packageDetails" style="padding:1rem 0;">
            <div class="container">
              <div class="row">
                <h2 style="margin-bottom:2rem;">Pack history</h2>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                       <th>Visits</th>
                       <th>Services done</th>
                    </tr>
                    <tr>
                      <td>First visit</td>
                      <td>'.$first_visit.'</td>
                    </tr>
                    <tr>
                      <td>Second visit</td>
                      <td>'.$second_visit.'</td>
                    </tr>
                    <tr>
                      <td>Third visit</td>
                      <td>'.$third_visit.'</td>
                    </tr>
                    <tr>
                      <td>Fourth visit</td>
                      <td>'.$fourth_visit.'</td>
                    </tr>
                    <tr>
                      <td>Fifth visit</td>
                      <td>'.$fifth_visit.'</td>
                    </tr>
                    <tr>
                      <td>Sixth visit</td>
                      <td>'.$sixth_visit.'</td>
                    </tr>
                    <tr>
                      <td>Seventh visit</td>
                      <td>'.$seventh_visit.'</td>
                    </tr>
                    <tr>
                      <td>Eightth visit</td>
                      <td>'.$eightth_visit.'</td>
                    </tr>
                    <tr>
                      <td>Nineth visit</td>
                      <td>'.$nineth_visit.'</td>
                    </tr>
                    <tr>
                      <td>Tenth visit</td>
                      <td>'.$tenth_visit.'</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </section>
          ';
        }
      }
    }
    ?>


    <section id="myAccountBookings" style="margin-top:2rem;">
      <div class="container">
        <div class="row">
            <h2>Your Bookings</h2>
            <div class="table-responsive">
              <table class="table table-striped">
              <?php
              $query = "SELECT * FROM booking WHERE email='$user_email';";
              $result = mysqli_query($conn, $query);
              $num_rows = mysqli_num_rows($result);
              $id_count = 1;
              $output = "<tr>
                 <th>Sr No.</th>
                 <th>Brand</th>
                 <th>Model</th>
                 <th>Vehicle No.</th>
                 <th>Service</th>
                 <th>Date</th>
              </tr>";

              if($num_rows > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $output .= "<tr>";
                  $output .= "<td>".($id_count)."</td>";
                  $output .= "<td>".$row['brand']."</td>";
                  $output .= "<td>".$row['model']."</td>";
                  $output .= "<td>".$row['vehicleno']."</td>";
                  $output .= "<td>".$row['service']."</td>";
                  $output .= "<td>".date("j M Y, h:ia", strtotime($row['datemade']))."</td>";
                  $output .= "</tr>";
                  $id_count += 1;
                }
              }
              else{
                $output = "No bookings yet.";
              }
              echo "$output";
              ?>
              </table>
            </div>
        </div>
      </div>
    </section>

  </div>
  <?php include_once "includes/footer.php"; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
