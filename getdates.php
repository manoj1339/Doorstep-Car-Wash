<?php
session_start();
include_once "includes/db.php";

if(isset($_POST['ok']))
{
  $email = user_input($_SESSION['CarUserEmail']);
  $sql = "SELECT * FROM datesforpackage WHERE email='$email' LIMIT 1;";
  $rslt = mysqli_query($conn, $sql);
  $rslt_rows = mysqli_num_rows($rslt);

  while($row = mysqli_fetch_assoc($rslt))
  {
    if($row['first'] == null)
    {
      echo "<p>Please choose dates</p>";
    }
    else
    {
      echo '
      <ul class="list-group">
        <li class="list-group-item"><b>First visit </b>- '.date("j M y", strtotime($row['first'])).'</li>
        <li class="list-group-item"><b>Second visit </b>- '.date("j M y", strtotime($row['second'])).'</li>
        <li class="list-group-item"><b>Third visit </b>- '.date("j M y", strtotime($row['third'])).'</li>
        <li class="list-group-item"><b>Fourth visit </b>- '.date("j M y", strtotime($row['fourth'])).'</li>
      </ul>
      ';
    }
  }
}
else
{
  header('location: index.php');
  exit();
}
?>
