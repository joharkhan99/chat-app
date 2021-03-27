<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($connection, $_POST['fname']);
$lname = mysqli_real_escape_string($connection, $_POST['lname']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$password = mysqli_real_escape_string($connection, $_POST['password']);
// $image = mysqli_real_escape_string($connection, $_FILES['image']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //check email valid

    $query = mysqli_query($connection, "SELECT email FROM users where email='$email'");
    if (mysqli_num_rows($query) > 0) {
      echo "$email - already taken.";
    } else {
      if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_type = $_FILES['image']['type'];

        // explode image and get extension name
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);   //get last index n arr which wwill be ext

        $extensions = ['png', 'jpg', 'jpeg'];

        if (in_array($img_ext, $extensions)) {

          // for unique file name
          $time = time();    //curr time
          $new_name = $time . $img_name;

          if (move_uploaded_file($tmp_name, "img/" . $new_name)) {
            $status = 'Active now';
            $random_id = rand(time(), 10000000);  //make random id for user

            // insert all user data
            $query = mysqli_query($connection, "INSERT INTO users(unique_id,fname,lname,email,password,img,status) VALUES($random_id,'$fname','$lname','$email','$password','$new_name','$status')");

            if ($query) { //if data inserted
              $query = mysqli_query($connection, "SELECT * from users where email='$email'");
              if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
              }
            } else {
              echo "Something went wrong!";
            }
          }
        } else {
          echo "Please select vlid image file - jpg, png, jpeg";
        }
      } else {
        echo "Please select an image";
      }
    }
  } else {
    echo "$email - not valid email";
  }
} else {
  echo "All fields are required";
}
