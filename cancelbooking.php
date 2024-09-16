<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> HOME </title>
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
            <form action="cancelbooking.php" method="POST">
                <label for="booking_id">Enter Booking ID to Cancel:</label>
                <input type="text" id="booking_id" name="booking_id" required>
                <input type="submit" name="cancel_booking" value="Cancel Booking">
            </form>

        <?php
            // Assume $booking_id, $ticket_id, or $registration_id is obtained from user input or session

            require_once "mysqli_conncet.php";
            $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());

            function cancelBooking($mysqli, $id, $table_name) {
                $query = "UPDATE $table_name SET status = 'cancelled' WHERE id = ?";
                $stmt = mysqli_prepare($mysqli, $query);
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            // Example: Cancelling a booking
            if (isset($_POST['cancel_booking'])) {
                $booking_id = $_POST['booking_id'];
                cancelBooking($mysqli, $booking_id, "bookings");
            }
        ?>

        </div>
    </section>

    <footer>  
    <nav class="navi">
        <p class="help">HELP</p>
        <a href="tr_aboutus.html">About Us</a>
        <a href="memfeedback.php">Customer Feedback & Review</a>
        <a href="FAQ.php">FAQ</a>
        <a href="tr_payment.html">Payment</a>
    </nav>
    </footer>
    <script>
        document.getElementById('cancelForm').addEventListener('submit', function(event) {
            var confirmation = confirm("Are you sure you want to cancel this booking?");
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission if user cancels
            }
        });
    </script>
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
    
</html>
