<?php
session_start();
include_once "config.php";

$email = mysqli_real_escape_string($connection, $_POST['email']);
$password = mysqli_real_escape_string($connection, $_POST['password']);


if (!empty($email) && !empty($password)) {
  $query = mysqli_query($connection, "SELECT * FROM users where email='$email' AND password='$password'");
  if (mysqli_num_rows($query) > 0) {

    $row = mysqli_fetch_assoc($query);

    // when user login then update his status to active
    $status = 'Active now';
    $query2 = mysqli_query($connection, "UPDATE users SET status='$status' WHERE unique_id={$row['unique_id']}");

    if ($query2) {
      $_SESSION['unique_id'] = $row['unique_id'];
      echo 'success';
    }
  } else {
    echo "Invalid email/password";
  }
} else {
  echo "Fill all fields.";
}
