<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "homecarservices";

date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d H:i:s');

$conn = mysqli_connect($servername, $username, $password, $db_name);
if(!$conn){
  die("Database Connection Failed");
}



function user_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function fetch_user_info_profile($conn, $email)
{
    // user info
    $query = "SELECT * FROM registration WHERE email='$email' LIMIT 1;";

  	$result = mysqli_query($conn, $query);
  	$result_rows = mysqli_num_rows($result);

    // $user_info = array();

  	if($result_rows > 0)
  	{
  		while($row_data = mysqli_fetch_assoc($result))
  		{
        $user_info = array(
          'firstname' => $row_data['firstname'],
          'lastname' => $row_data['lastname'],
          'email' => $row_data['email'],
          'mobile' => $row_data['mobile'],
          'alternate' => $row_data['alternate'],
          'brand' => $row_data['brand'],
          'model' => $row_data['model'],
          'vehicleno' => $row_data['vehicleno'],
          'address' => $row_data['address'],
          'datemade' => $row_data['datemade'],
          'profilephoto' => $row_data['profilephoto'],
          'moneyspent' => $row_data['moneyspent'],
        );

  		}

      if($user_info['profilephoto'] == null)
      {
        $user_info['profilephoto'] = "images/icons/user.png";
      }
      else
      {
        $user_info['profilephoto'] = $user_info['profilephoto'];
      }

  	}

    return $user_info;

  }

  /* function to know that time elapsed from activity */

  //Function definition
  function timeAgo($time_ago)
  {
      $time_ago = strtotime($time_ago);
      $cur_time   = time();
      $time_elapsed   = $cur_time - $time_ago;
      $seconds    = $time_elapsed ;
      $minutes    = round($time_elapsed / 60 );
      $hours      = round($time_elapsed / 3600);
      $days       = round($time_elapsed / 86400 );
      $weeks      = round($time_elapsed / 604800);
      $months     = round($time_elapsed / 2600640 );
      $years      = round($time_elapsed / 31207680 );
      // Seconds
      if($seconds <= 60){
          return "just now";
      }
      //Minutes
      else if($minutes <=60){
          if($minutes==1){
              return "one minute ago";
          }
          else{
              return "$minutes minutes ago";
          }
      }
      //Hours
      else if($hours <=24){
          if($hours==1){
              return "an hour ago";
          }else{
              return "$hours hrs ago";
          }
      }
      //Days
      else if($days <= 7){
          if($days==1){
              return "yesterday";
          }else{
              return "$days days ago";
          }
      }
      //Weeks
      else if($weeks <= 4.3){
          if($weeks==1){
              return "a week ago";
          }else{
              return "$weeks weeks ago";
          }
      }
      //Months
      else if($months <=12){
          if($months==1){
              return "a month ago";
          }else{
              return "$months months ago";
          }
      }
      //Years
      else{
          if($years==1){
              return "one year ago";
          }else{
              return "$years years ago";
          }
      }
  }

  // Function to compressed the image
 function compressImage($source_url, $destination_url, $quality) {

     //$quality :: 0 - 100

     if( $destination_url == NULL || $destination_url == "" ) $destination_url = $source_url;

     $info = getimagesize($source_url);

     if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg')
     {
         $image = imagecreatefromjpeg($source_url);
         //save file
         //ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file). The default is the default IJG quality value (about 75).
         imagejpeg($image, $destination_url, $quality);

         //Free up memory
         imagedestroy($image);
     }
     elseif ($info['mime'] == 'image/png')
     {
         $image = imagecreatefrompng($source_url);

         imageAlphaBlending($image, true);
         imageSaveAlpha($image, true);
         /* chang to png quality */
                $png_quality = 9 - round(($quality / 100 ) * 9 );
                imagePng($image, $destination_url, $png_quality);//Compression level: from 0 (no compression) to 9(full compression).
                //Free up memory
                imagedestroy($image);
     }
     else
     {
       return FALSE;
     }

     return $destination_url;
 }

 // Function to change the dimension of images
 function resize($newWidth, $newHeight, $originalFile, $targetFile) {

     $info = getimagesize($originalFile);
     $mime = $info['mime'];

     switch ($mime) {
             case 'image/jpeg':
                     $image_create_func = 'imagecreatefromjpeg';
                     $image_save_func = 'imagejpeg';
                     $new_image_ext = 'jpg';
                     break;

             case 'image/png':
                     $image_create_func = 'imagecreatefrompng';
                     $image_save_func = 'imagepng';
                     $new_image_ext = 'png';
                     break;

             case 'image/gif':
                     $image_create_func = 'imagecreatefromgif';
                     $image_save_func = 'imagegif';
                     $new_image_ext = 'gif';
                     break;

             default:
                     echo "<script>alert('File not supported');</script>";
     }
     $img = $image_create_func($originalFile);
         list($width, $height) = getimagesize($originalFile);

         $tmp = imagecreatetruecolor($newWidth, $newHeight);
         imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

         if (file_exists($targetFile))
         {
            unlink($targetFile);
         }
         $image_save_func($tmp, "$targetFile");
 }

 /*----------------Message sending function with sms gateway textlocal.in------------------*/
 function Send_message($number, $message)
 {
     // Account details
   $apiKey = urlencode('d26oDh1slbM-LFUmA4KavZsLlDFYbVu1wkIekk930j');

   // Message details
   $numbers = array("$number");
   $sender = urlencode(919423742888);
   $message = rawurlencode("$message");

   $numbers = implode(',', $numbers);

   // Prepare data for POST request
   $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

   // Send the POST request with cURL
   $ch = curl_init('https://api.textlocal.in/send/');
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $response = curl_exec($ch);
   curl_close($ch);

   // Process your response here
   return $response;
 }

 ?>
