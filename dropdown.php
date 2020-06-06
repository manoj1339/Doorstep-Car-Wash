<?php
include_once "includes/db.php";

if(isset($_POST['brand']))
{
  $brand = user_input($_POST['brand']);

  $query = "SELECT * FROM model WHERE brand='$brand';";
  $result = mysqli_query($conn, $query);

  echo '<option value="0" selected="selected">Select</option>';
  while($row = mysqli_fetch_assoc($result))
  {
    echo "<option value='".$row['model']."'>".$row['model']."</option>";
  }
}
else
{
  header("location: index.php");
  exit();
}
?>
