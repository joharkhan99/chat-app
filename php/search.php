<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($connection, $_POST['search_query']);

$query = mysqli_query($connection, "SELECT * from users where unique_id!={$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%' OR CONCAT_WS(' ',fname,lname) LIKE '%{$searchTerm}%')");

$output = '';

if (mysqli_num_rows($query) > 0) {
  include "data.php";
} else {
  $output .= 'No user found.';
}

echo $output;
