<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="ticket, receipt, QR code, CAPTCHA">
    <title>Print Ticket/Receipt/QR Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css">
    <script>
    function generateCaptcha() {
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        var captcha = '';
        for (var i = 0; i < 6; i++) {
            var index = Math.floor(Math.random() * chars.length);
            captcha += chars[index];
        }
        document.getElementById('captcha').innerHTML = captcha;
    }

    function validateCaptcha() {
        var userInput = document.getElementById('userInput').value;
        var captcha = document.getElementById('captcha').innerHTML;
        if (userInput === captcha) {
            alert('CAPTCHA verification successful!');
        } else {
            alert('CAPTCHA verification failed. Please try again.');
            generateCaptcha();
        }
    }
    function generateQRCode(text) {
        var canvas = document.getElementById("qrCodeCanvas");
        QRCode.toCanvas(canvas, text, function(error) {
            if (error) {
                console.error(error);
            } else {
                console.log("QR code generated successfully!");
            }
        });
    }
    </script>
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
            <h2>Print Your Ticket/Receipt/QR Code</h2>
            <form action="qrcode.php" method="POST">
                <label for="ticket_id">Enter Ticket ID:</label>
                <input type="text" id="ticket_id" name="ticket_id" required><br><br>

                <p>Enter the characters you see in below:</p>
                <div id="captcha"></div>
                <input type="text" id="userInput" placeholder="Enter CAPTCHA here">
                <button onclick="validateCaptcha()">Submit</button>
                <button onclick="generateCaptcha()">Refresh CAPTCHA</button>
                <script>generateCaptcha();</script>
                <br><br>
                <canvas id="qrCodeCanvas"></canvas>
                <br><br>
                <br><img width='200px' height='auto' src='QRcode1.png'>
                <br><input type="submit" name="submit" value="Print">
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