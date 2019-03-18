<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Calender </title>
    <link rel="stylesheet" href="home_styles.css">
  </head>
  <body>

    <?php
      require '/Applications/XAMPP/xamppfiles/htdocs/Schedule-MKR-/Functions_DBConnection.php';
      require '/Applications/XAMPP/xamppfiles/htdocs/Schedule-MKR-/class_definitions.php';
      $email = $_SESSION["email"];
      ?>

      <h2 id="calendar_greeting">Welcome <?= $email ?></h2>

    <?php

      $events_raw = fetchEvents($email);
      $events_ready = array();
      $days_temp = array();
      $days_unique = array();

      $events_total = eventsTotal($email);

      for ($i=0; $i < $events_total; $i++) {
        $temp_obj = new Event($events_raw[$i][1], $events_raw[$i][2], $events_raw[$i][3], $events_raw[$i][4], $events_raw[$i][5], $events_raw[$i][6]);

        array_push($events_ready, $temp_obj);
      }

      $week = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
      $i = 0;


      for($i = 0; $i < 7; $i++) {
        $day = $week[$i];
        ?>

          <h2> <?= $day ?></h2>
          <hr>

        <?php
        for ($j=0; $j < $events_total; $j++) {
          if (in_array($day, $events_ready[$j]->days)) {
            ?>
            <div class="events">
              <p>
                <span id="eventName"><?= $events_ready[$j]->name ?></span>
                <strong>Start time : </strong>
                <?= $events_ready[$j]->start ?>
                <strong>End time : </strong>
                <?= $events_ready[$j]->end ?>
                <strong>Details : </strong>
                <?= $events_ready[$j]->details ?>
              </p>
            </div>
            <hr>
            <?php
          }
        }

      }

      ?>
      <form action="create_event.php" class="newEvent" onsubmit="endSession();">
        <input type="hidden" name="sign_out" value="set">
        <input type="submit" value="Add a new event" />
      </form>
      <form action="home.php" class="newEvent">
        <input type="submit" value="Log out" />
      </form>
    </table>
  </body>
</html>
