<?php
session_start();
if (isset($_SESSION['unique_id'])) {

  include_once "config.php";
  $logout_id = mysqli_real_escape_string($connection, $_GET['logout_id']);

  if (isset($logout_id)) {

    $status = 'offline now';
    // once user logouts update status
    $query = mysqli_query($connection, "UPDATE users SET status='$status' WHERE unique_id=$logout_id");

    if ($query) {
      session_unset();
      session_destroy();
      header("Location: ../login.php");
    }
  } else {
    header("Location: ../users.php");
  }
} else {
  header("Location: ../login.php");
}
