<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require '/Applications/XAMPP/xamppfiles/htdocs/Schedule-MKR-/Functions_DBConnection.php';
      $eName = $_POST['eName'];
      $sHour = $_POST['sHour'];
      $eHour = $_POST['eHour'];
      $details = $_POST['details'];
      $days = "";

      if (isset($_POST["sunday"])) {
        $days = $days.="Sunday,";
      }
      if(isset($_POST["monday"])) {
        $days = $days.="Monday,";
      }
      if (isset($_POST["tuesday"])) {
        $days = $days.="Tuesday,";
      }
      if (isset($_POST["wednesday"])) {
        $days = $days.="Wednesday,";
      }
      if (isset($_POST["thursday"])) {
        $days = $days.="Thursday,";
      }
      if (isset($_POST["friday"])) {
        $days = $days.="Friday,";
      }
      if (isset($_POST["saturday"])) {
        $days = $days.="Saturday,";
      }

      storeEvent($eName, $sHour, $eHour, $details, $days);
    ?>

    <script type="text/javascript">
      window.location="calendar-page.php";
    </script>
  </body>
</html>
