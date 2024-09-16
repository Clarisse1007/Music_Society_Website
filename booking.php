<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="keywords">
        <title>BOOKING</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="UTF-8">
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
            <?php
                echo "<table style='width:90%; height:400px'> <tr> <td><h3>Event Title</h3></td> <td><h3>Event Description</h3></td> <td><h3>Date & Time</h3></td> <td><h3>Image</h3></td> <td><h3>Booking</h3></td> </tr>";
                require_once('mysqli_conncet.php');
                $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());
                $sql_readRecord = "SELECT * FROM events";
                $result_readRecord = mysqli_query($mysqli, $sql_readRecord);
                if ($result_readRecord) {
                    while ($row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC)){
                        echo "<tr align='left'><td><i>" . $row['event_title'] . "</i></td><td>" . $row['event_description'] . "</td><td width='20%'>" . $row['event_date_time']  . "</td><td>" . "<img width='200px' height='300px' src='" . $row['event_image1'] . "'></td><td><a href='make_booking.php?id=".urlencode($row['event_id'])."'>Booking</a></td></tr>";
                    }
                }
                echo "</table>";
            ?>
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