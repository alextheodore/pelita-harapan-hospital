<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
  <link rel="stylesheet" href="./css/style_signup.css">

</head>

<body>
  <form class="screen-1" action="conf/register.php" method="POST">

    <span class="login100-form-title p-b-43">
      <img src="images/logoo.png" style="width:350px;height:150px;">
    </span>

    <b style="text-align:center; font-size:150%; margin-top: -40px; color: #AC3163;"> Sign Up </b>

    <div class="email">
      <div class="sec-2">
        <input type="text" name="email" placeholder="Mobile Number or Email">
      </div>
    </div>

    <div class="email">
      <div class="sec-2">
        <input type="text" name="fullname" placeholder="Full Name">
      </div>
    </div>

    <div class="email">
      <div class="sec-2">
        <input type="text" name="username" placeholder="Username">
      </div>
    </div>

    <div class="email">
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input class="pas" type="password" name="password" placeholder="Password">
      </div>
    </div>

    <div class="email">
      <div class="sec-2">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input class="pas" type="password" name="confirm_password" placeholder="Confirm Password">
      </div>

    </div>
    <?php if (isset($_SESSION['error'])) {
      echo '<div id="errorMessage" class="alert alert-danger animate__animated animate__fadeInDown" role="alert" style="background-color: #fe4949; color: white; text-align: center; margin: 20px auto; padding: 15px; border-radius: 5px; width: 80%">'
        . htmlspecialchars($_SESSION['error']) . '</div>';
      unset($_SESSION['error']);
    } ?>
    <button class="login" type="submit">Sign Up </button>
    <span class="txt2">
      have an account? <a href="index.php"> Log in </a>
    </span>
    </div>

  </form>
  <!-- partial -->

</body>

</html>