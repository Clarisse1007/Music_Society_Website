<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> BOOKING </title>
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

            if (isset($_POST['block_unblock'])) {
                $memberId = $_POST['member_id'];
                $currentStatus = $_POST['current_status'];
                $newStatus = $currentStatus == 'M' ? 'B' : 'M';
                $sql_updateStatus = "UPDATE members SET member_login_status = '$newStatus' WHERE member_id = $memberId";
                mysqli_query($mysqli, $sql_updateStatus);
            }

            $sql_readRecord = "SELECT * FROM members WHERE member_login_status != 'A'";
            $result_readRecord = mysqli_query($mysqli, $sql_readRecord); 

            echo "<table> <tr> <td><h3>Member ID</h3></td> <td><h3>Member Name</h3></td> <td><h3>Member Password</h3></td> <td><h3>Action</h3></td> </tr>";

            if ($result_readRecord) {   
                while ($row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC)){      
                    echo "<tr align='left'><td><i>" . $row['member_id'] . "</i></td><td>" . $row['member_name'] . "</td><td>" . $row['member_password']  . "</td>";
                    echo "<td>
                            <form method='post' action=''>
                                <input type='hidden' name='member_id' value='" . $row['member_id'] . "'>
                                <input type='hidden' name='current_status' value='" . $row['member_login_status'] . "'>
                                <input type='submit' name='block_unblock' value='" . ($row['member_login_status'] == 'M' ? 'Block' : 'Unblock') . "'>
                            </form>
                          </td></tr>"; 
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
        <a href="memfeedback.html">Customer Feedback & Review</a>
        <a href="FAQ.php">FAQ</a>
    </nav>
</footer>
</html>