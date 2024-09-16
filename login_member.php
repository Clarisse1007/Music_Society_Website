<?php
session_start();

function detectError($studentID, $password) {
    $error = array();
    if (empty($studentID)) {
        $error['studentID'] = "Please enter student ID.";
    } elseif (!preg_match('/^[0-9]{1,20}$/', $studentID)) {
        $error['studentID'] = "Invalid student ID! Please try again!";
    }
    if (empty($password)) {
        $error['password'] = "Please enter your password.";
    } elseif (!preg_match('/^[0-9]{3,20}$/', $password)) {
        $error['password'] = "Invalid password. Please try again!";
    }
    return $error;
}

if (isset($_POST['studentID'], $_POST['password'])) {
    $studentID = $_POST['studentID'];
    $password = $_POST['password'];

    // Validate input
    $error = detectError($studentID, $password);
    if (!empty($error)) {
        $_SESSION['errors'] = $error;
    } else {
        // Database connection and query
        require_once('mysqli_conncet.php');
        $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());

        $sql_readRecord = "SELECT * FROM members WHERE member_id = ?";
        $stmt = mysqli_prepare($mysqli, $sql_readRecord);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $studentID);
            mysqli_stmt_execute($stmt);
            $result_readRecord = mysqli_stmt_get_result($stmt);

            if ($result_readRecord && mysqli_num_rows($result_readRecord) == 1) {
                $row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC);
                if ($row['member_password'] == $password) {
                    if ($row['member_login_status'] == 'B') {
                        $_SESSION['errors']['account'] = "Your account has been blocked! Please try another account to log in.";
                    } else {
                        $_SESSION['member_id'] = $studentID; // Set session variable after successful login
                        header("Location: memberHeader2.html");
                        exit();
                    }
                } else {
                    $_SESSION['errors']['access'] = "Access Denied.";
                }
            } else {
                $_SESSION['errors']['database'] = "Database query failed.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['errors']['database'] = "Database query preparation failed.";
        }
        mysqli_close($mysqli);
    }
}

// Check if session contains errors and display them
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $key => $value) {
        echo "<p><h2><font color='red'>$value</font></h2></p>";
    }
    unset($_SESSION['errors']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> MEMBER LOGIN </title>
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
    <section>
        <div>
            <table border="0" cellpadding="5">
            <tr>
                <td>
                    <center><h2>MEMBER LOGIN</h2></center><hr>
                    <form action="login_member.php" method="POST">
                        <label>Student ID</label>
                        <input type="text" name="studentID" value="<?php echo isset($_SESSION['member_id']) ? htmlspecialchars($_SESSION['member_id']) : ''; ?>">
                        <br><br>
                        <label>Password</label>
                        <input type="password" name="password">
                        <br><br>
                        <label for="rememberMe">Remember me:</label>
                        <input type="checkbox" name="rememberMe" id="rememberMe">
                        <br><br>
                        <button type="submit">LOGIN</button>
                        <br><br>
                        <p>Please <a href="register.php">register</a> if you don't have an account.</p>
                    </form>
                </td>
            </tr>  
            </table>
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