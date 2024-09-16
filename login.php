<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> ADMIN & MEMBER LOGIN </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css">
    
  
  <link rel="stylesheet" type="text/css" href="">  
</head>
<body>
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
                    <hr>
                    <p> Member login (e.g. member1, 123) will show member navigation/menu <p>
                    <p> Admin login (e.g. admin1, 123) will show admin navigation/menu <p>
                    <br>
                    <center><h2>ADMIN & MEMBER LOGIN</h2></center><hr>
                    <form action="login.php" method="post">
                            <label>Login Name</label>
                            <input type="text" name="loginName" value="">
                            <br><br>
                            <label>Password</label>
                            <input type="password" name="password" value="">
                            <br><br>
                            <button type="submit">LOGIN</button>
                            <br><br>

                            <p>Please <a href="">register</a> if you don't have any account.</p>
                    
                    <?php
                        if (isset($_POST['loginName']) && isset($_POST['password'])) {      
                            $member_name = $_POST['loginName'];
                            $member_password = $_POST['password'];

                            //~~~~~~validation
                            if ($member_password == null) {
                                    $error['$member_password'] = "";
                            }

                            if (empty($error)) {
                                    //~~~~~~read database and validate the loginName and password
                                    require_once('mysqli_conncet.php');
                                    $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());
                                    $sql_readRecord = "SELECT * FROM members WHERE member_name = '$member_name' AND member_password = '$member_password'";
                                    $result_readRecord = mysqli_query($mysqli, $sql_readRecord); 
                                    if ($result_readRecord && mysqli_num_rows($result_readRecord) == 1) {           			
                                            $row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC);
                                            if ($row['member_login_status'] == "A"){
                                                    echo "Hi <b>Admin</b>! You are login successfully" . "<br>";
                                                    header('Refresh:5; url=home1.php?status=A');				
                                            } else if ($row['member_login_status'] == "M"){
                                                    echo "Hi <b>Member</b>! You are login successfully" . "<br>";
                                                    header('Refresh:5; url=home1.php?status=M');				
                                            }		
                                            echo "We will redirect to the homepage soon...";
                                    } else {
                                            echo "Access Denied" . "<br>";
                                    }

                            } else {
                                    //!empty($error)
                            }
                        }
                    ?>
                    </form>

                </td>
            </tr>  
            </table> 
        </div>
    </section>
       
<footer>  
        <nav class="navi">
            <p class="help">HELP</p>
            <a href="tr_aboutus.html">About Us</a>
            <a href="memfeedback.php">Customer Feedback & Review</a>
            <a href="tr_FAQ.html">FAQ</a>
            <a href="tr_payment.html">Payment</a>
        </nav>
    </footer>  
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