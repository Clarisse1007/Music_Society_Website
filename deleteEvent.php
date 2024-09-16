<?php
require_once('mysqli_conncet.php');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ("Could not connect to database: " . mysqli_connect_error() );

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['yes'])) {
    $event_title = trim($_POST['event_title']); 
    $sql_deleteRecord = "DELETE FROM event WHERE event_title = '$event_title'";
    $result_deleteRecord = mysqli_query($mysqli, $sql_deleteRecord);
} else {
    $event_title = "";
    $event_description = "";
    $event_date_time ="";
    $event_image = "";

    if (isset($_GET['id'])) {
        $event_title = $_GET['id'];
        $sql_readRecord = "SELECT * FROM `event` WHERE event_title = '$event_title'";
        $result_readRecord = mysqli_query($mysqli, $sql_readRecord);
        $row = mysqli_fetch_assoc($result_readRecord);

        if ($row) { 
            $event_title = $row['event_title']; 
            $event_date_time = $row['event_date_time'];
            $event_description = $row['event_description'];
            $event_image = $row['event_image'];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> MANAGE BOOKING </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css">
  
  
</head>
<body>
    <header>
        <div class="logo">
            <a><img src="Music.png" alt="Music"></a>
        </div>
        <nav class="horizontal">
            <ul class="mainmenu">
                <li>
                    <a href="#" class="submenuTitle">Members &#9654;</a>
                    <ul class="submenu">
                        <li><a href="register.php">Registration</a></li>
                        <li><a href="login_member.php">Log In</a></li>
                        <li><a href="editprofile.php">Edit Profile</a></li>
                        <li>
                            <a href="#" class="submenuTitle1">Bookings &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href="#">Book A Ticket</a></li>
                                <li><a href="cancelbooking.php">Cancellation</a></li>
                                <li><a href="view_booking.php">View Status</a></li>
                                <li><a href="qrcode.php">QR code</a></li>
                            </ul>
                        </li>
                        <li><a href="memfeedback.php">Feedback</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenuTitle">Admin &#9654;</a>
                    <ul class="submenu">
                        <li><a href="login_staff.php">Log In</a></li>
                        <li>
                            <a href="#" class="submenuTitle1">Member &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href='view_block_member.php'>1. View / Block Members</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="submenuTitle1">2. Bookings &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href='manage_booking.php'>2. View Booking Records</a></li>
                                <li><a href="viewfeedback.php">View Feedback</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenuTitle">Event &#9654;</a>
                    <ul class="submenu">
                        <li><a href="event.php">View event</a></li>
                        <li><a href="event1.php">Search Event</a></li>
                        <li><a href="event2.php">Search Event</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    
    <section>
        <div>
            <p>[ <a>View Event Information</a> | <a>Delete Event Information</a> ]</p>
                <h1>Delete Event</h1>
                <h3>Are you sure you want to delete the following event record?</h3>
            <form action="deleteEvent.php" method="post">
                
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>  
                        <td>Event Title</td>
                        <td><input type="text" name="event_title" value="<?php echo htmlspecialchars($event_title); ?>" maxlength="255" readonly /></td>
                    </tr>
                    <tr>
                        <td>Event Description</td>
                        <td><input type="text" name="event_description" value="<?php echo htmlspecialchars($event_description); ?>" readonly /></td>
                    </tr>
                    <tr>
                        <td>Event Date and Time</td>
                        <td><input type="text" name="event_date_time" value="<?php echo htmlspecialchars($event_date_time); ?>" readonly/></td>
                    </tr>
                    <tr>
                        <td>Event Image</td>
                        <td><input type="text" name="event_image" value="<?php echo htmlspecialchars($event_image); ?>" readonly /></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="yes" value="Yes" />
                <input type="button" value="Cancel" onclick="window.location.href='your_cancel_page.php'" />
            </form>
        </div>
    </section>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.submenuTitle').click(function() {
                $(this).next('.submenu').slideToggle();
            });

            $('.submenu a').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                window.location.href = url;
            });
        });
    </script>
</body>
<footer>  
    <nav class="navi">
        <p class="help">HELP</p>
        <a href="aboutus.html">About Us</a>
        <a href="memfeedback.php">Customer Feedback & Review</a>
        <a href="FAQ.php">FAQ</a>
    </nav>
</footer>
</html>