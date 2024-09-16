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
<?php
require_once('mysqli_conncet.php');
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());
if(isset($_POST['update_status'])) {
    $bookingId = $_POST['booking_id'];
    $newStatus = $_POST['status'];
    $sql_updateStatus = "UPDATE booking SET status = '$newStatus' WHERE booking_id = $bookingId";
     if (mysqli_query($mysqli, $sql_updateStatus)) {
        header("Location: manage_booking.php");
     }
     } 

$sql_readRecord = "SELECT * FROM booking";
$result_readRecord = mysqli_query($mysqli, $sql_readRecord); 
?>

<table>
    <tr>
        <td><h3>Booking ID</h3></td>
        <td><h3>Member ID</h3></td>
        <td><h3>Event ID</h3></td>
        <td><h3>Quantity</h3></td>
        <td><h3>Booking Date</h3></td>
        <td><h3>Status</h3></td>
    </tr>

<?php
if ($result_readRecord) {   
    while ($row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC)){      
        echo "<tr align='left'>
                <td><i>" . $row['booking_id'] . "</i></td>
                <td>" . $row['member_id'] . "</td>
                <td>" . $row['event_id']  . "</td>
                <td>" . $row['quantity']  . "</td>
                <td>" . $row['booking_date']  . "</td>
                <td>" . $row['status']  . "<br>
                    <form method='post' action=''>
                        <select name='status'>
                            <option value='Success'>Success</option>
                            <option value='Canceled'>Canceled</option>
                            <option value='Pending'>Pending</option>
                            <option value='Failed'>Failed</option>
                        </select>
                        <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>
                        <input type='submit' name='update_status' value='Update'>
                    </form>
                </td>
            </tr>"; 
    }  
}
?>

</table>



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