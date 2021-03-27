<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("Location: login.php");
}
?>

<?php include_once "includes/header.php"; ?>

<div class="wrapper">
  <section class="chat-area">

    <header>

      <?php
      include_once "php/config.php";
      $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

      $query = mysqli_query($connection, "SELECT * from users where unique_id={$user_id}");
      if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
      }
      ?>

      <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <img src="php/img/<?php echo $row['img'] ?>" alt="">
      <div class="details">
        <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
        <p><?php echo $row['status'] ?></p>
      </div>
    </header>

    <!-- display messages in this block -->
    <div class="chat-box"></div>

    <form action="#" class="typing-area">

      <!-- hidden field for sending sender id's -->
      <input type="text" name="outgoing_id" class="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>

      <!-- hidden field for sending reciever id's -->
      <input type="text" name="incoming_id" class="incoming_id" value="<?php echo $user_id; ?>" hidden>

      <input type="text" name="message" class="input-field" placeholder="your message" autocomplete="off">

      <button><i class="fab fa-telegram-plane"></i></button>

    </form>

  </section>
</div>

<script src="js/chat.js"></script>
</body>

</html>