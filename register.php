<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> MEMBER REGISTRATION </title>
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
            <table>
              <tr><td>
                    <center><h2>MEMBER REGISTRATION</h2></center><hr>
                    <?php
                    function detectInputError() {
                            global $studentID,$studentPassword,$studentName,$studentGmail;
                            $error = array();

                            if ($studentID == null){
                                $error['member_id'] = "Please enter student ID.";
                            }
                            else if(!preg_match('/^[0-9]{1,20}$/',$studentID)){
                                $error['member_id']="Invalid student ID!Please try again!";
                            }
                            if($studentPassword == null){
                                $error['member_password']="Please enter your password.";
                            }
                            else if(!preg_match('/^[0-9]{3,20}$/',$studentPassword)){
                                $error['member_password']="Invalid password,Please try again!";
                            }
                            if ($studentName == null){
                                $error['member_name'] = "Please enter your Student name.";
                            }
                            else if(strlen ($studentName) > 20){
                                $error['member_name'] = "The name is more than 20 characters.";
                            }
                            else if(!preg_match('/^[a-zA-Z0-9]{1,20}$/', $studentName)){
                                $error['member_name'] = "The name contains invalid characters.";
                            }
                            if($studentGmail == null){
                                $error['member_gmail']="Please enter Email.";
                            }
                            else if(!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $studentGmail)){
                                $error['member_gmail'] = "Invalid email, please try again!";
                            }
                            return $error;
                    }
            ?>
             <?php
                    if(isset($_POST['submit'])){
                        $studentID = isset($_POST['member_id']) ? $_POST['member_id'] : '';
                        $studentPassword = isset($_POST['member_password']) ? $_POST['member_password'] : '';
                        $studentName = isset($_POST['member_name']) ? $_POST['member_name'] : '';
                        $studentGmail = isset($_POST['member_gmail']) ? $_POST['member_gmail'] : '';

                        //~~~~~~~~~~~~~validation
                        $error = detectInputError();
                        if(empty($error)){
                           //~~~~~~~~~~~~store in database
                           require_once('mysqli_conncet.php');
                        $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());
                            $sql_insertRecord = "INSERT INTO members (member_id, member_password, member_name, member_login_status,member_gmail) 
                                                              VALUES ('$studentID', '$studentPassword', '$studentName', 'M','$studentGmail')";
                        $result_insertRecord = mysqli_query($mysqli, $sql_insertRecord);

                            if ($result_insertRecord) { 
                            header("Location:login_member.php");
                            echo "<p><h2> <font color='blue'> Successful Registration. </font> </h2></p>";
                        } 
                        else {
                            echo "<p><h2> <font color='red'> Unsuccessful Registration. </font> </h2></p>";
                        }
                        mysqli_close($mysqli);  	

                    }   else {
                        foreach($error as $key => $value){
                            echo "<p><h2> <font color='red'> $value </font> </h2></p>";
                        }			
                        }
                    }

            ?>     
                                <form action="register.php" method="POST">
                                <p> [ <a href="login_member.php"> LOGIN PAGE</a> ] </p>
                                <label for="member_id">Student ID:</label>
                                <input type="text" name="member_id" id="member_id">
                                <br><br>
                                <label for="member_password">Student Password:</label>
                                <input type="text" name="member_password" id="member_password">
                                <br><br>
                                <label for="member_name">Student Name:</label>
                                <input type="text" name="member_name" id="member_name"> 	     
                                <br><br>
                                <label for="member_gmail">Email:</label>
                                <input type="text" name="member_gmail" id="member_gmail">
                                <br><br>
                                <button type="submit" name='submit' value='Submit'>SUBMIT</button>
                                <button type="reset" value='Reset'>RESET</button>
                                <br>
                                </form>
                          </td></tr>
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