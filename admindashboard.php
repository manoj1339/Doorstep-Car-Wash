<?php
session_start();
include_once "includes/db.php";

$output = "";
$pack_output = "";

if(isset($_SESSION['adminLogin']))
{
  if(isset($_POST['submit']))
  {
    $email = user_input($_POST['email']);
    $email = strtolower($email);

    $query = "SELECT * FROM package_details INNER JOIN bookpackage ON package_details.email = bookpackage.email WHERE package_details.email='$email' AND bookpackage.status='activated' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    if($num_rows > 0)
    {
      while ($row_data = mysqli_fetch_assoc($result)) {

        $first_visit = $row_data['first'];
        $second_visit = $row_data['second'];
        $third_visit = $row_data['third'];
        $fourth_visit = $row_data['fourth'];
        $fifth_visit = $row_data['fifth'];
        $sixth_visit = $row_data['sixth'];
        $seventh_visit = $row_data['seventh'];
        $eightth_visit = $row_data['eightth'];
        $nineth_visit = $row_data['nineth'];
        $tenth_visit = $row_data['tenth'];

        $plan = $row_data['plan'];
        $plan_charge = $row_data['plancharge'];
        $datemade = $row_data['datemade'];
        $dateexpire = $row_data['dateexpire'];
        $plan_visit = $row_data['planvisit'];
        $status = $row_data['status'];

        $output = '
        <section id="packageDetails" style="padding:1rem 0;">
          <div class="container">
            <div class="row">
              <h2 style="margin-bottom:2rem;">Pack history</h2>
              <div class="table-responsive">
                <form action="" method="post">
                <table class="table table-striped">
                  <tr>
                     <th>Visits</th>
                     <th>Services done</th>
                  </tr>
                  <tr>
                    <td>First visit</td>
                    <td><input type="text" name="first" value="'.$first_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Second visit</td>
                    <td><input type="text" name="second" value="'.$second_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Third visit</td>
                    <td><input type="text" name="third" value="'.$third_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Fourth visit</td>
                    <td><input type="text" name="fourth" value="'.$fourth_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Fifth visit</td>
                    <td><input type="text" name="fifth" value="'.$fifth_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Sixth visit</td>
                    <td><input type="text" name="sixth" value="'.$sixth_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Seventh visit</td>
                    <td><input type="text" name="seventh" value="'.$seventh_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Eightth visit</td>
                    <td><input type="text" name="eightth" value="'.$eightth_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Nineth visit</td>
                    <td><input type="text" name="nineth" value="'.$nineth_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Tenth visit</td>
                    <td><input type="text" name="tenth" value="'.$tenth_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Active plan</td>
                    <td><input type="text" name="plan" value="'.$plan.'" disabled/></td>
                  </tr>
                  <tr>
                    <td>Plan visit</td>
                    <td><input type="text" name="planVisit" value="'.$plan_visit.'" /></td>
                  </tr>
                  <tr>
                    <td>Plan charge</td>
                    <td><input type="text" name="planCharge" value="'.$plan_charge.'" disabled/></td>
                  </tr>
                  <tr>
                    <td>Plan status</td>
                    <td><input type="text" name="status" value="'.$status.'" /></td>
                  </tr>
                  <tr>
                    <td>From date</td>
                    <td><input type="text" name="datemade" value="'.date("F jS, Y", strtotime($datemade)).'" disabled/></td>
                  </tr>
                  <tr>
                    <td>To date</td>
                    <td><input type="text" name="dateexpire" value="'.date("F jS, Y", strtotime($dateexpire)).'" disabled/></td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" value="'.$email.'" disabled/>
                      <input type="hidden" name="useremail" value="'.$email.'" />
                    </td>
                    <td><input type="submit" name="update" value="Update Data" /></td>
                  </tr>
                </table>
                </form>
              </div>
            </div>
          </div>
        </section>
        ';
      }
    }
    else {
      $output = "No results found";
    }
  }

  if(isset($_POST['update']))
  {
    $first = user_input($_POST['first']);
    $second =user_input($_POST['second']) ;
    $third = user_input($_POST['third']);
    $fourth = user_input($_POST['fourth']);
    $fifth =user_input( $_POST['fifth']);
    $sixth = user_input($_POST['sixth']);
    $seventh = user_input($_POST['seventh']);
    $eightth = user_input($_POST['eightth']);
    $nineth = user_input($_POST['nineth']);
    $tenth = user_input($_POST['tenth']);
    $uemail = user_input($_POST['useremail']);

    $plan_visit = user_input($_POST['planVisit']);
    $status = user_input($_POST['status']);

    $sql = "UPDATE package_details INNER JOIN bookpackage ON package_details.email = bookpackage.email SET package_details.first='$first', package_details.second='$second', package_details.third='$third', package_details.fourth='$fourth', package_details.fifth='$fifth', package_details.sixth='$sixth', package_details.seventh='$seventh',
    package_details.eightth='$eightth', package_details.nineth='$nineth', package_details.tenth='$tenth', bookpackage.planvisit=$plan_visit,bookpackage.status='$status' WHERE package_details.email='$uemail';";

    $rslt = mysqli_query($conn, $sql);

    if($rslt)
    {
      $output = "Data updated successfully";
    }
    else{
      $output = mysqli_error($conn);
    }
  }
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
  <title>Admin Dashboard</title>

  <link rel="shortcut icon" href="images/icon.png" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  <link rel="stylesheet" href="style/style.css">
  <style media="screen">
    #packageDetails input[type='text']{
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <div style="max-width: 400px;margin: 5rem auto 0 auto;">
      <a href="logout.php">Log out</a>
      <form action="" method="post">
        <div style="text-align:center;margin-top:1rem;">
          <img src="images/logo14.png" alt="logo" style="width: 160px;" />
        </div>
        <div style="text-align:center;margin-top:1rem;">
          <input type="text" name="email" placeholder="Enter user Email" />
        </div>
        <div style="text-align:center;margin-top:1rem;">
          <input type="submit" name="submit" value="Submit" />
        </div>
      </form>
    </div>
  </div>
  <?php echo "$output"; ?>
</body>
</html>
