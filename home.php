<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Schedule MKR+</title>
    <link rel="stylesheet" href="home_styles.css">
    <script type="text/javascript" src="JS_Functions_Login.js">

    </script>
  </head>
  <body>
    <img src="Mock_Schedule.png" alt="Mock Schedule">
    <h1>Schedule MKR+</h1>

    <?php

      if (isset($_POST['login_message'])) {
        $message = $_POST['login_message'];
        ?> <h2><?= $message ?></h2><?php
      }
      if (isset($_POST['sign_out'])) {
        unset($_SESSION["email"]);
        session_destroy();
      }

    ?>

    <form name="signInForm" class="signin" onsubmit="return signInFieldCheck();" action="signin_validate.php" method="post">
      <table>
        <tr>
          <td>Email  </td><td><input class="signin_input" type="email" name="email" placeholder="Email"></td>
        </tr>
        <tr>
          <td>Password  </td><td><input class="signin_input" type="password" name="password" placeholder="Password"></td>
          <td><input type="submit" value="submit"></td>
        </tr>
      </table>
    </form>

    <h2>New user? Sign up below!</h2>
    <form name="signUpForm" class="signin" onsubmit="return signUpFieldCheck();" action="signin_validate.php" method="post">
      <table>
        <tr>
          <td>Email  </td><td><input class="signin_input" type="email" name="email_new" placeholder="Email"></td>
        </tr>
        <tr>
          <td>Password  </td><td><input class="signin_input" type="password" name="password_new" placeholder="Password"></td>
        </tr>
        <tr>
          <td>Confirm Password  </td><td><input class="signin_input" type="password" name="password_confirm" placeholder="Confirm Password"></td>
          <td><input type="submit" value="submit"></td>
        </tr>
      </table>
    </form>
  </body>
</html>
