<?php
                session_start();

                if (!isset($_SESSION['member_id'])) {
                    header("Location: login_member.php");
                    exit();
                }

                require_once "mysqli_conncet.php";

                $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die("Connection failed: " . mysqli_connect_error());

                $member_id = $_SESSION['member_id'];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $query = "SELECT member_name, member_gmail, member_password FROM members WHERE member_id = ?";
                    $stmt = mysqli_prepare($mysqli, $query);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $member_id);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $db_member_name, $db_gmail, $db_password);
                        mysqli_stmt_fetch($stmt);
                        mysqli_stmt_close($stmt);

                        $member_name = $_POST['member_name'];
                        $email = $_POST['member_gmail'];
                        $current_password = $_POST['current_password'];
                        $new_password = $_POST['new_password'];

                        // Verify current password
                        if ($current_password === $db_password) {
                            // Update member_name and email
                            $update_query = "UPDATE members SET member_name = ?, member_gmail = ? WHERE member_id = ?";
                            $update_stmt = mysqli_prepare($mysqli, $update_query);

                            if ($update_stmt) {
                                mysqli_stmt_bind_param($update_stmt, "sss", $member_name, $member_gmail, $member_id);
                                mysqli_stmt_execute($update_stmt);
                                mysqli_stmt_close($update_stmt);
                            } else {
                                echo "Failed to prepare update statement for member_name and email.";
                            }

                            // Update password
                            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                            $update_password_query = "UPDATE members SET member_password = ? WHERE member_id = ?";
                            $update_password_stmt = mysqli_prepare($mysqli, $update_password_query);

                            if ($update_password_stmt) {
                                mysqli_stmt_bind_param($update_password_stmt, "ss", $hashed_password, $member_id);
                                mysqli_stmt_execute($update_password_stmt);
                                mysqli_stmt_close($update_password_stmt);
                            } else {
                                echo "Failed to prepare update statement for password.";
                            }

                            echo "Profile updated successfully.";
                        } else {
                            echo "Current password is incorrect.";
                        }
                    } else {
                        echo "Failed to prepare select statement." . mysqli_error($mysqli);
                    }
                    mysqli_close($mysqli);
                }
            ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> EDIT PROFILE </title>
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
            <h2>Member Profile</h2>
            <form action="editprofile.php" method="post">
                <label for="member_name">Member Name:</label>
                <input type="text" id="member_name" name="member_name" required><br>
                <label for="member_gmail">Email:</label>
                <input type="email" id="member_gmail" name="member_gmail" required><br>
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required><br>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required><br>
                <input type="submit" value="Update Profile">
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