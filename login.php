<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("Location: users.php");
}
?>

<?php include_once "includes/header.php"; ?>

<div class="wrapper">
  <section class="form login">
    <header>Chat</header>
    <form action="">
      <div class="error-txt">error message text</div>
      <div class="field input">
        <label for="">Email</label>
        <input type="email" name="email" placeholder="Email">
      </div>
      <div class="field input">
        <label for="">Password</label>
        <input type="password" name="password" id="password" placeholder="Password">
        <i class="fas fa-eye"></i>
      </div>
      <div class="field button">
        <input type="submit" name="" value="Chat">
      </div>
    </form>

    <div class="link">Not yet Signed up? <a href="index.php">Sign up</a></div>

  </section>
</div>

<script src="js/password.js"></script>
<script src="js/login.js"></script>
</body>

</html>