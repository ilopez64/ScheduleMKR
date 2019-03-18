<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require '/Applications/XAMPP/xamppfiles/htdocs/Schedule-MKR-/Functions_DBConnection.php';

      if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = fetchEmail($email);

        if ($password === $result['Item']['password']['S']) {
          $validation = "password_correct";
        } else {
          $validation = "password_incorrect";
        }

      } else if (isset($_POST["email_new"]) && isset($_POST["password_new"]) && isset($_POST["password_confirm"])) {
        $email_new = $_POST["email_new"];
        $password_new = $_POST["password_new"];
        $password_confirm = $_POST["password_confirm"];

        $isNew = newEmail($email_new);

        if ($isNew) {
          if ($password_new !== $password_confirm) {
            $validation = "password_confirm_fail";
          } else {
            storeEmail($email_new, $password_new);
            $validation = "successful_creation";
            $email = $email_new;
          }
        } else {
          $validation = "email_repeated";
        }

      } else {
        $validation = "insufficient_fields";
      }

      handle_login($validation);

     ?>
  </body>
</html>
