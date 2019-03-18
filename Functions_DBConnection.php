<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="JS_Functions_Login.js" type="text/javascript">

    </script>
  </head>
  <body>
    <?php

      require '/Applications/XAMPP/xamppfiles/htdocs/Schedule-MKR-/vendor/autoload.php';
      use Aws\DynamoDb\DynamoDbClient;

      session_start();

    /* Database Related Funtions */

      function fetchEmail($email) { // Retrieve an array of all an item's attributes based on the email passed
        $result = $GLOBALS['client']->getItem(array(
          'ConsistentRead' => true,
          'TableName' => 'User_Sign_In',
          'Key'       => array(
            'email'     => array('S' => $email)
            )
        ));
        return $result;
      }

      function eventsTotal($email) {
        $result = $GLOBALS['client']->getItem(array(
          'ConsistentRead' => true,
          'TableName' => 'events_total',
          'Key'       => array(
            'email'     => array('S' => $email)
            )
        ));
        return $result['Item']['events']['S'];
      }

      function fetchEvents($email) { // Recieve the events for the current user in a 2D array
        $events = array();
        $result = $GLOBALS['client']->getItem(array(
          'ConsistentRead' => true,
          'TableName' => 'events_total',
          'Key'       => array(
            'email'     => array('S' => $email)
            )
        ));
        $events_total =  $result['Item']['events']['S'];

        for ($i=1; $i <= $events_total; $i++) {
          $f = (string)$i;
          $result = $GLOBALS['client']->getItem(array(
            'ConsistentRead' => true,
            'TableName' => 'User_Events',
            'Key'       => array(
              'email'     => array('S' => $email),
              'event_no'  => array('S' => $f)
              )
          ));
          $relevant_info = array();

          array_push($relevant_info, $result['Item']['email']['S']); // Extract only the relevant information
          array_push($relevant_info, $result['Item']['event_no']['S']);
          array_push($relevant_info, $result['Item']['eName']['S']);
          array_push($relevant_info, $result['Item']['sHour']['S']);
          array_push($relevant_info, $result['Item']['eHour']['S']);
          array_push($relevant_info, $result['Item']['days']['S']);
          array_push($relevant_info, $result['Item']['details']['S']);

          array_push($events, $relevant_info);
        }

        return $events;
      }

      function storeEvent($eName, $sHour, $eHour, $details, $days) {
        $email = $_SESSION["email"];

        $result = $GLOBALS['client']->getItem(array( // Get the number of events existing for the user
          'ConsistentRead' => true,
          'TableName' => 'events_total',
          'Key'       => array(
            'email'     => array('S' => $email)
            )
        ));

        $events = $result['Item']['events']['S']; // Increment their total number of events

        $event_no = $events + 1;

        settype($event_no, "string");


        $result = $GLOBALS['client']->putItem(array( // Add the new event with the proper event number
          'TableName' => 'User_Events',
          'Item' => array(
            'email' => array('S' => $email),
            'eName' => array('S' => $eName),
            'sHour' => array('S' => $sHour),
            'eHour' => array('S' => $eHour),
            'details' => array('S' => $details),
            'days' => array('S' => $days),
            'event_no' => array('S' => $event_no)
          )
        ));

        $result = $GLOBALS['client']->putItem(array( // Update the users total number of events
          'TableName' => 'events_total',
          'Item' => array(
            'email'    => array('S' => $email),
            'events'   => array('S' => $event_no)
          )
        ));

      }

      /*
      function removeEvent ($$eName) { // Delete an event via the event name
        $email = $_SESSION["email"];



        $result = $GLOBALS['client']->deleteItem(array(
          'TableName' => 'User_Events',
          'Item' => array(
            'email' => array('S' => $email),
            'event_no'   => array('S' => $event_no)
          )
        ));

      }
      */

      function storeEmail($email_new, $password_new) { // Add an email and password as a new item to the database
        $result = $GLOBALS['client']->putItem(array(
          'TableName' => 'User_Sign_In',
          'Item' => array(
            'email'    => array('S' => $email_new),
            'password' => array('S' => $password_new)
          )
        ));

        $result = $GLOBALS['client']->putItem(array( // Record their total number of events starting at zero
          'TableName' => 'events_total',
          'Item' => array(
            'email'    => array('S' => $email_new),
            'events'   => array('S' => "0")
          )
        ));
      }

      function newEmail($email_new) { // Verify whether an email is already in use
        $result = fetchEmail($email_new);
        if ($email_new !== $result['Item']['email']['S']) {
          return true;
        } else {
          return false;
        }
      }

      function handle_login($validation) { // Determine what to pass on, and where, i.e. username to the user's homepage, etc.
        switch ($validation) {
          case 'successful_creation':
          case 'password_correct':
            $page = "calendar-page.php";
            $name = "user";
            $value = $GLOBALS['email'];
            $_SESSION["email"] = $value;
            break;
          case 'password_incorrect':
            $page = "home.php";
            $name = "login_message";

            $value = "The password and/or email were incorrect";
            break;
          case 'password_confirm_fail':
            $page = "home.php";
            $name = "login_message";

            $value = "The password confirmation did not match the password entered";
            break;
          case 'email_repeated':
            $page = "home.php";
            $name = "login_message";

            $value = "An account is already registered with this email";
            break;
          case 'insufficient_fields':
            $page = "home.php";
            $name = "login_message";

            $value = "Not enough fields were entered";
            break;
          default:
            break;
        }

        ?>

          <form id="login_result" action="<?= $page ?>" method="post">
            <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
          </form>
          <script type="text/javascript"> // Needed in order to return to home.php or calendar-page.html with the proper values
            window.onload = toHome();
          </script>

        <?php
      }

    /******************************************************************************/

    /* Database Connection Establishment */

      $client = DynamoDbClient::factory(array(
        'version' => 'latest',
        'profile' => 'default',
        'region'  => 'us-east-1'
      ));

    /******************************************************************************/

     ?>

  </body>
</html>
