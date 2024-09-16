<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BOOKING/JOIN EVENT</title>
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
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="editprofile.php">Edit Profile</a></li>
                        <li>
                            <a href="#" class="submenuTitle1">Bookings &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href="#">Book A Ticket</a></li>
                                <li><a href="cancelbooking.php">Cancellation</a></li>
                                <li><a href="#">View Status</a></li>
                                <li><a href="#">QR code</a></li>
                            </ul>
                        </li>
                        <li><a href="memfeedback.php">Feedback</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenuTitle">Admin &#9654;</a>
                    <ul class="submenu">
                        <li><a href="login.php">Log In</a></li>
                        <li>
                            <a href="#" class="submenuTitle1">Member &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href="#">View Members</a></li>
                                <li><a href="#">Block Member</a></li>
                                <li><a href="#">Delete Member</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="submenuTitle1">Bookings &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href="#">View Bookings</a></li>
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
                <li>
                    <a href="#" class="submenuTitle">Buy Now &#9654;</a>
                    <ul class="submenu">
                        <li><a href="tr_cart.html">Add to Cart</a></li>
                        <li><a href="tr_payment.html">Payment</a></li>
                        <li><a href="tr_delivery.html">Product Delivery</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <h1>Join the Event</h1>
    <form action="join_form.php" method="post">
        <label for="member_id">MEMBER ID:</label>
        <input type="text" id="member_id" name="member_id" required><br>
        <label for="event_id">EVENT ID:</label>
        <input type="text" id="event_id" name="event_id" required><br>

        <h2>Select Event:</h2>
        <table border="1">
            <tr>
                <th>Event Title</th>
                <th>Event Date and Time</th>
                <th>Event Poster</th>
                <th>Total Seat</th>
                <th>Remaining Seat</th>
                <th>Join and Book</th>
            </tr>

            <?php
            require_once('mysqli_conncet.php');
            $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Could not connect to database: " . mysqli_connect_error());

            $sql_readRecord = "SELECT event_id, event_title, event_date_time, event_image1, total_seat, remaining_seat FROM events";
            $result_readRecord = mysqli_query($mysqli, $sql_readRecord);

            if ($result_readRecord) {
                while ($row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC)) {
                    $event_image = isset($row['event_image1']) ? $row['event_image1'] : 'default.jpg'; // Use a default image if not available
                    $total_seat = isset($row['total_seat']) ? $row['total_seat'] : 'N/A';
                    $remaining_seat = isset($row['remaining_seat']) ? $row['remaining_seat'] : 'N/A';

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['event_title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['event_date_time']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($event_image) . "' alt='Event Poster' style='width:100px;height:100px;'></td>";
                    echo "<td>" . htmlspecialchars($total_seat) . "</td>";
                    echo "<td>" . htmlspecialchars($remaining_seat) . "</td>";
                    echo "<td>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='selected_event_id' value='" . htmlspecialchars($row['event_id']) . "'>";
                    echo "<input type='submit' value='Join and Book'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No events found.</td></tr>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_event_id'])) {
                $member_id = $_POST['member_id'];
                $event_id = $_POST['selected_event_id'];

                // Fetch event details
                $event_query = "SELECT * FROM events WHERE event_id = ?";
                $stmt = $mysqli->prepare($event_query);
                $stmt->bind_param('i', $event_id);
                $stmt->execute();
                $event_result = $stmt->get_result();
                $event = $event_result->fetch_assoc();

                if ($event && $event['remaining_seat'] > 0) {
                    // Update remaining seats
                    $update_query = "UPDATE events SET remaining_seat = remaining_seat - 1 WHERE event_id = ?";
                    $stmt = $mysqli->prepare($update_query);
                    $stmt->bind_param('i', $event_id);
                    $stmt->execute();

                    // Insert booking record
                    $insert_query = "INSERT INTO booking (user_id, event_id, booking_date, status) VALUES (?, ?, NOW(), 'confirmed')";
                    $stmt = $mysqli->prepare($insert_query);
                    $stmt->bind_param('ii', $member_id, $event_id);
                    $stmt->execute();

                    echo "You have successfully booked the " . htmlspecialchars($event['event_title']) . " event.";
                } else {
                    echo "Sorry, the " . htmlspecialchars($event['event_title']) . " event has no more seats available.";
                }
            }

            $mysqli->close();
            ?>
        </table>
    </form>
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
        <a href="tr_aboutus.html">About Us</a>
        <a href="memfeedback.php">Customer Feedback & Review</a>
        <a href="FAQ.php">FAQ</a>
        <a href="tr_payment.html">Payment</a>
    </nav>
</footer>
</html>