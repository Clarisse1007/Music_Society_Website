<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="keywords">
        <title>HOME 2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>
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
                </ul>
            </nav>
        </header>		       
	
        <section>
            <div>
                <?php
                    session_start();
                    if (!isset($_SESSION['from_home1']) || !isset($_SESSION['status'])) {
                        header("Location: home1.php");
                        exit();
                    }

                        $status = $_SESSION['status'];

                        if ($status == 'A') {
                            $dashboard = 'login_staff.php';
                        } elseif ($status == 'M') {
                            $dashboard = 'memberHeader.html';
                        }else {
                            header("Location: home1.php");
                            exit();
                        }

                    include $dashboard;
                    exit();
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
<?php		
    unset($_SESSION['from_home1']);
    unset($_SESSION['status']);