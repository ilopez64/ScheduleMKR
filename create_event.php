<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Schedule MKR+</title>
        <link rel="stylesheet" href="home_styles.css">
        <script type="text/javascript" src="JS_Functions_Login.js"></script>
    </head>
<body>
    <h1>Create an Event</h1>

    <form class="signin" action="event-get.php" method="post">
        <input class="signin_input" type="text" name="eName" placeholder="Event Name"> </br>
        <div>
            <input type = "checkbox" name="sunday" value = "sunday"/>Sunday
            <input type = "checkbox" name="monday" value = "monday"/>Monday
            <input type = "checkbox" name="tuesday" value = "tuesday"/>Tuesday
            <input type = "checkbox" name="wednesday" value = "wednesday"/>Wednesday
            <input type = "checkbox" name="thursday" value = "thursday"/>Thursday
            <input type = "checkbox" name="friday" value = "friday"/>Friday
            <input type = "checkbox" name="saturday" value = "saturday"/>Saturday
        </div> </br>
        Start Time:   &nbsp; End Time:
        <div>
            <select name = "sHour" size = "4" multiple = "multiple">
                <optgroup label = "Hour">
                    <option selected = "selected">6 AM</option>
                    <option>7 AM</option>
                    <option>8 AM</option>
                    <option>9 AM</option>
                    <option>10 AM</option>
                    <option>11 AM</option>
                    <option>12 PM</option>
                    <option>1 PM</option>
                    <option>2 PM</option>
                    <option>3 PM</option>
                    <option>4 PM</option>
                    <option>5 PM</option>
                    <option>6 PM</option>
                    <option>7 PM</option>
                    <option>8 PM</option>
                    <option>9 PM</option>
                    <option>10 PM</option>
                    <option>11 PM</option>
                    <option>12 PM</option>
                </optgroup>
            </select>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <select name = "eHour" size = "4" multiple = "multiple">
                <optgroup label = "Hour">
                    <option selected = "selected">6 AM</option>
                    <option>7 AM</option>
                    <option>8 AM</option>
                    <option>9 AM</option>
                    <option>10 AM</option>
                    <option>11 AM</option>
                    <option>12 PM</option>
                    <option>1 PM</option>
                    <option>2 PM</option>
                    <option>3 PM</option>
                    <option>4 PM</option>
                    <option>5 PM</option>
                    <option>6 PM</option>
                    <option>7 PM</option>
                    <option>8 PM</option>
                    <option>9 PM</option>
                    <option>10 PM</option>
                    <option>11 PM</option>
                    <option>12 PM</option>
                </optgroup>
            </select>
        </div> </br>
        <div Event box>
            <textarea name = "details" placeholder="Enter event details"></textarea>
        </div>
        <input type="submit" value="submit">
    </form>
  </body>
</html>
