<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('mysqli_conncet.php');
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());

if(isset($_GET['id'])) {
    $id = urldecode($_GET['id']);
    $sql_readRecord = "SELECT * FROM events WHERE event_id='$id'";
    $result_readRecord = mysqli_query($mysqli, $sql_readRecord);

    if($result_readRecord) {
        $row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC);
    } else {
        echo "Error fetching event details: " . mysqli_error($mysqli); 
    }
}

if(isset($_POST['book'])) {
    $member_id = $_POST['member_id'];
    $quantity = $_POST['quantity'];

    if(isset($id)) {
        $total_seat_query = "SELECT total_seat FROM events WHERE event_id='$id'";
        $total_seat_result = mysqli_query($mysqli, $total_seat_query);

        if($total_seat_result) {
            $total_seat_row = mysqli_fetch_assoc($total_seat_result);
            $total_seat = $total_seat_row['total_seat'];
            $updated_total_seat = $total_seat - intval($quantity);

            $sql_updateRecord = "UPDATE events SET total_seat='$updated_total_seat' WHERE event_id='$id'";
            if(mysqli_query($mysqli, $sql_updateRecord)) {
                echo "Event seat updated successfully.";
            } else {
                echo "Error updating event seat: " . mysqli_error($mysqli);
            }

            $sql_insertRecord = "INSERT INTO booking (member_id, event_id, quantity, status) VALUES ('$member_id', '$id', '$quantity', 'Pending')";
            if(mysqli_query($mysqli, $sql_insertRecord)) {
                echo "Booking made successfully. Status: Pending";
            } else {
                echo "Error creating booking: " . mysqli_error($mysqli); 
            }

        } else {
            echo "Error fetching total seat: " . mysqli_error($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="keywords">
    <title>BOOKING</title>
    <link rel="stylesheet" href="style.css" />
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
            <section>
                <div>
                    <form method="post" action="make_booking.php">
                        <input type="hidden" name="event_id" value="<?php echo isset($row['event_id']) ? $row['event_id'] : ''; ?>">
                        <br><label>Event ID:</label>
                        <input type="text" name="event_id" value="<?php echo isset($row['event_id']) ? $row['event_id'] : ''; ?>" readonly>
                        <br><label>Member ID:</label>
                        <input type="text" name="member_id">
                        <br><label>Quantity:</label>
                        <input type="number" name="quantity">
                        <br><input type="submit" name="book" value="Book">
                    </form>
                </div>
                <div></div>
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

</html>