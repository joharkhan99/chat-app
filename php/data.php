<?php

while ($row = mysqli_fetch_assoc($query)) {

  $query2 = "SELECT * FROM chat where (incoming_msg_id={$row['unique_id']} OR outgoing_msg_id={$row['unique_id']}) AND (outgoing_msg_id={$outgoing_id} OR outgoing_msg_id={$outgoing_id}) ORDER BY msg_id DESC";

  $result2 = mysqli_query($connection, $query2);
  $row2 = mysqli_fetch_assoc($result2);

  if (mysqli_num_rows($result2) > 0) {
    $result = $row2['msg'];
  } else {
    $result = "No message available";
  }

  // trim message to show small message
  (strlen($result) > 28) ? $msg = substr($result, 0, 20) . '...' : $msg = $result;

  // adding you before msg if login id send msg
  ($outgoing_id == $row2['outgoing_msg_id']) ? $you = 'You: ' : $you = '';

  // check user is online/offline
  ($row['status'] == 'offline now') ? $offline = 'offline' : $offline = '';

  $output .= '
        <a href="chat.php?user_id=' . $row['unique_id'] . '">
          <div class="content">
            <img src="php/img/' . $row['img'] . '" alt="">
              <div class="details">
                <span>' . $row["fname"] . " " . $row["lname"] . '</span>
                <p>' . $you . $msg . '</p>
              </div>
            </div>
            <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
        </a>
      ';
}
