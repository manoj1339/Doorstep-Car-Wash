<?php
include_once "includes/db.php";

if(isset($_POST['name']))
{
  $name = user_input($_POST['name']);
  $email = user_input($_POST['email']);
  $message = user_input($_POST['message']);

  $name = ucwords($name);

  if($name == "" || $email == "" || $message == "")
  {
    echo "Please fill all fields";
  }
  else
  {
    $query = "INSERT INTO feedback (name, email, message, datemade) VALUES ('$name', '$email', '$message', '$now');";
    $result = mysqli_query($conn, $query);

    if($result)
    {
      echo "success";
    }
    else
    {
      echo "Something went wrong";
    }
  }

}
else
{
  header('location: index.php');
  exit();
}
?>
