<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header("Location: login.php");
}
?>

<?php include_once "includes/header.php"; ?>

<div class="wrapper">
  <section class="users">

    <header>

      <?php
      include_once "php/config.php";
      $query = mysqli_query($connection, "SELECT * from users where unique_id={$_SESSION['unique_id']}");
      if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
      }
      ?>

      <div class="content">
        <img src="php/img/<?php echo $row['img'] ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
          <p><?php echo $row['status'] ?></p>
        </div>
      </div>
      <a href="php/logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?>" class="logout">Logout</a>

    </header>

    <div class="search">
      <span class="text">Select user to start chat</span>
      <input type="text" name="" placeholder="Enter name to search...">
      <button><i class="fas fa-search"></i></button>
    </div>

    <div class="users-list">

    </div>

</div>

</section>
</div>


<script src="js/user-page.js?v=<?php echo time() ?>"></script>
</body>

</html>