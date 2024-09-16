<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> EVENT </title>
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
            <?php
            require_once('mysqli_conncet.php');
            $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());

            if(isset($_GET['id'])) {
                $title = urldecode($_GET['id']);
                $sql_readRecord = "SELECT * FROM events WHERE event_id='$event_id'";
                $result_readRecord = mysqli_query($mysqli, $sql_readRecord); 
                $row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC);
            } 

            if(isset($_POST['update'])) {
                $title = $_POST['event_title'];
                $event_description = $_POST['event_description'];
                $event_date_time = $_POST['event_date_time'];
                $event_image1 = $_POST['event_image1'];

                $sql_updateRecord = "UPDATE events SET event_title='$title', event_description='$event_description', event_date_time='$event_date_time', event_image1='$event_image1' WHERE event_title='$title'";
                mysqli_query($mysqli, $sql_updateRecord);
                header("Location: event.php");
            }
            ?>

            <form method="post" action="editEvent.php">
                <table border="1" cellpadding="5" cellspacing="0">
                <tr>
			<td> Enter Event ID to Edit Current Existing Event</td>
                        <td><input type="text" name="event_id" value="<?php echo isset($row['event_id']) ? $row['event_id'] : ''; ?>" readonly></td>
                </tr>
                <tr>
                        <td><br><br><label>Event ID:</label></td>
                        <td><input type="text" name="event_id" value="<?php echo isset($row['event_id']) ? $row['event_id'] : ''; ?>"></td>
                </tr>
                <tr>
                        <td><br><br><label>Event Title:</label></td>
                        <td><input type="text" name="event_title" value="<?php echo isset($row['event_title']) ? $row['event_title'] : ''; ?>"></td>
                </tr>
                <tr>
                        <td><br><br><label>Event Description:</label></td>
                        <td><textarea name="event_description"><?php echo isset($row['event_description']) ? $row['event_description'] : ''; ?></textarea></td>
                </tr>
                <tr>
                        <td><br><br><label>Date & Time:</label></td>
                        <td><input type="datetime" name="event_date_time" value="<?php echo isset($row['event_date_time']) ? $row['event_date_time'] : ''; ?>"></td>
                </tr>
                <tr>
                        <td><br><br><label>Image:</label></td>
                        <td><input type="text" name="event_image1" value="<?php echo isset($row['event_image1']) ? $row['event_image1'] : ''; ?>"></td>
                </tr>
                </table>
                <br><br><input type="submit" name="update" value="Update">
            </form>
        </div>
    </section>
        
</body>	
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