<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> FEEDBACK </title>
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
            <h2>Event Feedback Form</h2>
            <form action="memfeedback.php" method="POST">
                <label for="event_id">Event ID:</label>
                <input type="text" id="event_id" name="event_id" required><br><br>

                <label for="member_id">Member ID:</label>
                <input type="text" id="member_id" name="member_id" required><br><br>

                <label for="feedback_text">Feedback:</label><br>
                <textarea id="feedback_text" name="feedback_text" rows="4" cols="50" required></textarea><br><br>

                <label for="rating">Rating:</label><br>
                <input type="radio" id="like" name="rating" value="like">
                <label for="like">Like</label><br>
                <input type="radio" id="dislike" name="rating" value="dislike">
                <label for="dislike">Dislike</label><br><br>

                <input type="submit" value="Submit Feedback">
            </form>
        <?php
            // Include database connection
            require_once "mysqli_conncet.php";
            $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());

            // Function to submit feedback
            function submitFeedback($mysqli, $event_id, $member_id, $feedback_text, $rating) {
                // Prepare and execute SQL INSERT statement
                $query = "INSERT INTO feedback (event_id, member_id, feedback_text, rating, timestamp) VALUES (?, ?, ?, ?, NOW())";
                $stmt = mysqli_prepare($mysqli, $query);
                mysqli_stmt_bind_param($stmt, "iisi", $event_id, $member_id, $feedback_text, $rating);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            // Example: Handling form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $event_id = $_POST['event_id'];
                $member_id = $_POST['member_id'];
                $feedback_text = $_POST['feedback_text'];
                $rating = isset($_POST['rating']) ? $_POST['rating'] : null; // Assuming radio button input for rating

                // Validate input (e.g., check if event_id and member_id are valid)

                // Submit feedback to the database
                submitFeedback($mysqli, $event_id, $member_id, $feedback_text, $rating);
            }
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