<?php
session_start();

if (isset($_SESSION['unique_id'])) {
  include_once "config.php";
  $outgoing_id = mysqli_real_escape_string($connection, $_POST['outgoing_id']);
  $incoming_id = mysqli_real_escape_string($connection, $_POST['incoming_id']);
  $message = mysqli_real_escape_string($connection, $_POST['message']);

  if (!empty($message)) {
    $query = mysqli_query($connection, "INSERT INTO chat(incoming_msg_id,outgoing_msg_id,msg) VALUES($incoming_id,$outgoing_id,'$message')") or die();
  }
} else {
  header("Location: ../login.php");
}
