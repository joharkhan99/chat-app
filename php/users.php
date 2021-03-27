<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$output = '';
$query = mysqli_query($connection, "SELECT * FROM users where unique_id!={$outgoing_id}");

if (mysqli_num_rows($query) == 1) {
  $output .= "No users available to chat";
} elseif (mysqli_num_rows($query) > 0) {
  include "data.php";
  echo $output;
}
