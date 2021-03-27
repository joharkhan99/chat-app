<?php

$connection = mysqli_connect('localhost', 'root', '', 'chat_app');

if (!$connection) {
  die("DATABASE CONNECTION FAILED" . mysqli_connect_error());
}
